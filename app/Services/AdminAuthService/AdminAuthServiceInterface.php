<?php

namespace App\Services\AdminAuthService;

interface AdminAuthServiceInterface
{
    public function register(array $data): object;
    public function login(array $credentials, bool $remember): bool;
    public function logout(): void;
    public function getAdmin(): object;
    public function updateProfile(array $data): object;
    public function updatePassword(string $currentPassword, string $newPassword): object;
}
