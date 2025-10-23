<?php

namespace App\Services\Admin;

use App\Repositories\AdminAuth\AdminAuthRepositoryInterface;
use App\Services\Admin\AdminServiceInterface;
use App\Services\MediaLibrary\MediaLibraryServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService implements AdminServiceInterface
{
    public function __construct(
        protected AdminAuthRepositoryInterface $admin,
        protected MediaLibraryServiceInterface $mediaLibrary
    ) {}

    public function getAdmins(array $columns = ['*'], int $perPage = 15): object
    {
        return $this->admin->get($columns, $perPage);
    }

    public function getAllAdmins(): object
    {
        return $this->admin->all();
    }

    public function getAdminsList(): object
    {
        return $this->admin->list();
    }

    public function findAdmin(int $id): object
    {
        return $this->admin->find($id);
    }

    public function createAdmin(array $data, ?UploadedFile $media = null): object
    {
        if ($media) {

            $existingMedia = $this->mediaLibrary->query()->where('original_name', $media->getClientOriginalName())->first();

            if ($existingMedia) {
                $data['media_id'] = $existingMedia->id;
            } else {
                $uploaded = $this->mediaLibrary->upload($media);
                $data['media_id'] = $uploaded->id;
            }
        }

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'user';

        return $this->admin->create($data);
    }

    public function updateAdmin(int $id, array $data): object
    {
        if (isset($data['media_id'])) {
            if (empty($data['media_id']) || $data['media_id'] === 'null') {
                $data['media_id'] = null;
            } else {
                // Verify the selected media exists
                $existingMedia = $this->mediaLibrary->findMedia($data['media_id']);
                if (!$existingMedia) {
                    $data['media_id'] = null;
                }
            }
        }
        return $this->admin->update($id, $data);
    }

    public function deleteAdmin(int $id)
    {
        if (Auth::guard('admin')->user()->role === 'admin') {
            return back()->with('error', 'This user cannot be deleted.');
        }

        return $this->admin->delete($id);
    }

    public function updatePassword(array $data)
    {
        $admin = Auth::guard('admin')->user();

        if (!Hash::check($data['current_password'], $admin->password)) {
            throw new \Exception('Current password is incorrect');
        }

        $updateData = [
            'password' => Hash::make($data['new_password'])
        ];

        return $this->admin->update($admin->id, $updateData);
    }
}
