<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagesModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tb_packages';
    protected $fillable = [
        'id',
        'package_name',
        'package_price',
        'description',
        'id_tailor',
        'created_at',
        'updated_at',
    ];

    public function tailor()
    {
        return $this->belongsTo(TailorModel::class, 'id_tailor');
    }
}
