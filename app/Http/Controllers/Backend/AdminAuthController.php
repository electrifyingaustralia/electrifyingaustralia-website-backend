<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
use App\Http\Requests\Backend\RegisterRequest;
use App\Services\AdminAuthService\AdminAuthServiceInterface;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function __construct(protected AdminAuthServiceInterface $adminAuthService) {}

    public function showRegisterFrom()
    {
        return view();
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $this->adminAuthService->register($data);
    }

    public function showLoginFrom()
    {
        return view();
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $remember = $request->filled('remember');

        $loginSuccess = $this->adminAuthService->login($credentials, $remember);

        if ($loginSuccess) {
            return redirect()->route('');
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        $this->adminAuthService->logout();
        return redirect()->route('');
    }
}
