<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function indexAdmin(Request $request)
    {
        $courses = Course::all();
        $allLessons = Lesson::all();
        
        return view("admin/adminLesson", ['lessons' => $allLessons, 'courses' => $courses]);
    }
            
    public function editAdmin(Request $request)
    {
        Lesson::where("id", $request->id)->update([
            "name" => $request->name,
            "description" => $request->description,
            "link" => $request->link,
            "duration" => $request->duration,
            "course_id" => $request->course_id
        ]);

        return redirect("/adminLesson");
    }

    public function deleteAdmin(Request $request)
    {
        Lesson::where("id", $request->id)->delete();
        return redirect("/adminLesson");
    }

    public function addAdmin(Request $request)
    {
        Lesson::create([
            "name" => $request->name,
            "description" => $request->description,
            "link" => $request->link,
            "duration" => $request->duration,
            "course_id" => $request->course_id
        ]);

        return redirect("/adminLesson");
    }

    //api функционал

    public function apiLessons(Request $request, $id){
        $token = $request->bearerToken();
        $lessons = Lesson::where("course_id", $id)->latest()->get();

        return response()->json([
            "data" => $lessons
        ], 200);
    }
}
