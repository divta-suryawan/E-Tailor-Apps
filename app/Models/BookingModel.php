<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tb_booking';
    protected $fillable = [
        'id',
        'customer_namer',
        'phone_number',
        'booking_date',
        'appointment_date',
        'id_package',
    ];

    public function package()
    {
        return $this->belongsTo(PackagesModel::class, 'id_package');
    }
}
