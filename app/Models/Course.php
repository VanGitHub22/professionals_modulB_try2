<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Lesson;
use App\Models\Order;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "duration", "price", "date_start", "date_end"];

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
