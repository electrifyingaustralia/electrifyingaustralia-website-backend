<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
use App\Http\Requests\Backend\RegisterRequest;
use App\Services\AdminAuthService\AdminAuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AdminAuthServiceInterface $authService) {}

    public function showRegisterFrom()
    {
        return view();
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $this->authService->register($data);
    }

    public function showLoginFrom()
    {
        return view();
    }

    public function login(LoginRequest $request)
    {
        if ($this->authService->login(
            $request->only('email', 'password'),
            $request->filled('remember')
        )) {
            return redirect()->route('');
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('admin.login');
    }
}
