<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    use HasFactory;
    protected $table = 'tb_example';
    protected $fillable = [
        'id' , 'example' ,'created_at' , 'updated_at'
    ];
}
