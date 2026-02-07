<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Course;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "link", "duration", "course_id"];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
