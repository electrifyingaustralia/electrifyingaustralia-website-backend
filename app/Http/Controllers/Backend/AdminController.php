<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminServiceInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(protected AdminServiceInterface $adminService) {}

    public function index()
    {
        $admins = $this->adminService->getAdmins();
        return view();
    }

    // public function create()
    // {
    //     return view();
    // }

    // public function store() {

    // }

    public function show($id)
    {
        $admin = $this->adminService->findAdmin($id);
        return view();
    }

    // public function edit()
    // {

    // }

    // public function update()
    // {

    // }

    public function destroy($id)
    {
        $this->adminService->deleteAdmin($id);
        return redirect();
    }
}
