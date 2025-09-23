<?php

namespace App\Services\AdminAuthService;

use App\Repositories\AdminAuth\AdminAuthRepositoryInterface;
use App\Services\AdminAuthService\AdminAuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthService implements AdminAuthServiceInterface
{
    public function __construct(protected AdminAuthRepositoryInterface $adminAuthRepository) {}

    public function register(array $data): object
    {
        $data['password'] = Hash::make($data['password']);
        return $this->adminAuthRepository->create($data);
    }

    public function login(array $credentials, bool $remember): bool
    {
        return Auth::guard('admin')->attempt($credentials, $remember);
    }

    public function logout(): void
    {
        Auth::guard('admin')->logout();
    }

    public function getAdmin(): object
    {
        return Auth::guard('admin')->user();
    }

    public function updateProfile(array $data): object
    {
        $admin = $this->getAdmin();
        return $this->adminAuthRepository->update($admin->id, $data);
    }

    public function updatePassword(string $currentPassword, string $newPassword): object
    {
        $admin = $this->getAdmin();
        return $this->adminAuthRepository->update($admin->id, [
            'password' => Hash::make($newPassword)
        ]);
    }
}
