<?php

namespace App\Services\Interfaces;

use App\Models\Resident;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;

interface ResidentServiceInterface
{
    public function getAll(): Collection;
    public function create(array $data, ?UploadedFile $photo): Resident;
    public function update(int $id, array $data, ?UploadedFile $photo): Resident;
    public function delete(int $id): bool;
    public function findById(int $id): Resident;
}
