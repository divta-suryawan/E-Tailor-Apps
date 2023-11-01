<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TailorModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'tb_tailor';
    protected $fillable = [
        'id', 'tailor_name', 'address', 'phone', 'email', 'tailor_img', 'description', 'id_user', 'created_at', 'updated_at'
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function packages()
    {
        return $this->hasMany(ExampleModel::class, 'id_tailor');
    }
}
