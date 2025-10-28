<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminCreateRequest;
use App\Http\Requests\Backend\AdminUpdateRequest;
use App\Services\Admin\AdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct(protected AdminServiceInterface $adminService) {}

    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view('backend.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('backend.admin.create');
    }

    public function store(AdminCreateRequest $request)
    {
        $data = $request->validated();

        $this->adminService->createAdmin($data);

        return response()->json([
            'success' => true,
            'message' => 'Admin user created successfully',
            'redirect' => route('admin.users.all')
        ]);
    }

    public function edit($id)
    {
        $admin = $this->adminService->findAdmin($id);
        return view('backend.admin.edit', compact('admin'));
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->adminService->updateAdmin($id, $data);
        return response()->json([
            'success' => true,
            'message' => 'Admin user updated successfully',
            'redirect' => route('admin.users.all')
        ]);
    }

    public function showChangePassword()
    {
        return view('backend.admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);

        try {
            $data = $request->only(['current_password', 'new_password']);
            $this->adminService->updatePassword($data);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->with('success', 'Password changed successfully. Please login again with your new password.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['current_password' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $admin = $this->adminService->findAdmin($id);
        if ($admin->id === auth()->guard('admin')->id())
            return redirect()->back()->with('error', 'You cannot delete your own account');

        $this->adminService->deleteAdmin($id);

        return redirect()->back()->with('success', 'Admin user deleted successfully!');
    }
}
