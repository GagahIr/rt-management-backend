<?php

namespace App\Services;

use App\Models\Resident;
use App\Repositories\Interfaces\ResidentRepositoryInterface;
use App\Services\Interfaces\ResidentServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ResidentService implements ResidentServiceInterface
{
    protected ResidentRepositoryInterface $residentRepository;
    private const PHOTO_PATH = 'images/residents';

    public function __construct(ResidentRepositoryInterface $residentRepository)
    {
        $this->residentRepository = $residentRepository;
    }

    public function getAll(): Collection
    {
        return $this->residentRepository->getAll();
    }

    public function create(array $data, ?UploadedFile $photo): Resident
    {
        if ($photo) {
            $data['id_photo'] = $photo->store(self::PHOTO_PATH, 'public');
        }
        return $this->residentRepository->create($data);
    }

    public function update(int $id, array $data, ?UploadedFile $photo): Resident
    {
        $resident = $this->residentRepository->findById($id);

        if ($photo) {
            if ($resident->id_photo && Storage::disk('public')->exists($resident->id_photo)) {
                Storage::disk('public')->delete($resident->id_photo);
            }
            $data['id_photo'] = $photo->store(self::PHOTO_PATH, 'public');
        } else {
            unset($data['id_photo']);
        }

        return $this->residentRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $resident = $this->residentRepository->findById($id);

        if ($resident->id_photo) {
            Storage::disk('public')->delete($resident->id_photo);
        }

        return $this->residentRepository->delete($id);
    }

    public function findById(int $id): Resident
    {
        return $this->residentRepository->findById($id);
    }
}
