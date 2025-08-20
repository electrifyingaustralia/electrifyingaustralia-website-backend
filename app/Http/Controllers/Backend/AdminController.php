<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminCreateRequest;
use App\Http\Requests\Backend\AdminUpdateRequest;
use App\Services\Admin\AdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct(protected AdminServiceInterface $adminService) {}

    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view('Backend.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('backend.admin.create');
    }

    public function store(AdminCreateRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->uploadAvatar($request->file('avatar'));
        }

        $data['password'] = Hash::make($data['password']);

        $this->adminService->createAdmin($data);

        return redirect()->route('admin.users')->with('success', 'Admin created successfully!');
    }

    // public function show($id)
    // {
    //     $admin = $this->adminService->findAdmin($id);
    //     return view();
    // }

    public function edit($id)
    {
        $admin = $this->adminService->findAdmin($id);
        return view('Backend.admin.edit', compact('admin'));
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $admin = $this->adminService->findAdmin($id);

        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']);
        else unset($data['password']);

        if ($request->hasFile('avatar')) {
            if ($admin->avatar) {
                Storage::disk('public')->delete($admin->avatar);
            }
            $data['avatar'] = $this->uploadAvatar($request->file('avatar'));
        } else {
            $data['avatar'] = $admin->avatar;
        }

        $this->adminService->updateAdmin($id, $data);
        return redirect()->route('admin.users.all')->with('success', 'Admin Updated Successfully');
    }

    public function destroy($id)
    {
        $admin = $this->adminService->findAdmin($id);
        if ($admin->id === auth()->id())
            return redirect()->back()->with('error', 'You cannot delete your own account');

        if ($admin->avatar) Storage::disk('public')->delete($admin->avatar);

        $this->adminService->deleteAdmin($id);
        return redirect()->back()->with('success', 'Admin user deleted successfully!');
    }

    protected function uploadAvatar($file): string
    {
        return $file->store('admins', 'public');
    }
}
