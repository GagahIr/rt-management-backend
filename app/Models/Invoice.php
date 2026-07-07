<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'house_id',
        'resident_id',
        'payment_type_id',
        'amount',
        'period_month',
        'period_year',
        'status',
        'payment_date',
    ];

    protected $casts = [
        'amount'       => 'integer',
        'period_month' => 'integer',
        'period_year'  => 'integer',
        'payment_date' => 'date',
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentTypes::class);
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'Lunas');
    }

    public function scopePeriod($query, $month, $year)
    {
        return $query->where('period_month', $month)->where('period_year', $year);
    }
}