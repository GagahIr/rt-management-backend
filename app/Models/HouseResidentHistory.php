<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseResidentHistory extends Model
{
    use HasFactory;

    protected $table = 'house_resident_histories';

    protected $fillable = [
        'id_house',
        'id_resident',
        'start_date',
        'end_date'
    ];

    public function house()
    {
        return $this->belongsTo(House::class, 'id_house');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'id_resident');
    }
}
