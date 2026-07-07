<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $table = 'residents';

    protected $fillable = [
        'full_name',
        'id_photo',
        'phone_number',
        'status',
        'house_status'
    ];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute(): ?string
    {
        if ($this->id_photo) {
            return url(\Illuminate\Support\Facades\Storage::url($this->id_photo));
        }
        return null;
    }

    public function houseHistories()
    {
        return $this->hasMany(HouseResidentHistory::class, 'id_resident');
    }
}
