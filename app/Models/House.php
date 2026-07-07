<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'houses';
    public $timestamps = false;

    protected $fillable = [
        'house_code',
    ];

    protected $appends = ['status'];

    public function getStatusAttribute(): string
    {
        return $this->currentResident()->exists() ? 'Dihuni' : 'Tidak dihuni';
    }

    public function histories()
    {
        return $this->hasMany(HouseResidentHistory::class, 'id_house');
    }

    public function currentResident()
    {
        return $this->hasOne(HouseResidentHistory::class, 'id_house')->whereNull('end_date')->orWhereDate('end_date', '>', now());
    }
}
