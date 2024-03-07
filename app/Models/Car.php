<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    // Trong laravel nếu đặt tên Model là Car mà bảng  thay vì đặt tên cars bằng car thì bảng trong db nên đặt tên là cars. Còn nếu khong thì nên đình nghĩa lại bảng sẽ ánh xạ 
    // protected $table = 'car';
    use HasFactory;
}
