<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //User функционал

    public function index(Request $request)
    {

        $courses = Course::select([
            "name",
            "description",
            "duration",
            "price",
            "date_start",
            "date_end",
        ])
        ->paginate(5);

        $allCourses = Course::all();

        return view("courses/index", ['courses' => $courses, "allCourses" => $allCourses]);
    }

    //Admin функционал

    public function indexAdmin(Request $request)
    {

        $courses = Course::select([
            "id",
            "name",
            "description",
            "duration",
            "price",
            "date_start",
            "date_end",
        ])
        ->paginate(5);
            
        $allCourses = Course::all();
        
        return view("admin/admin", ['courses' => $courses, "allCourses" => $allCourses]);
    }
            
    public function editAdmin(Request $request)
    {
        Course::where("id", $request->id)->update([
            "name" => $request->name,
            "description" => $request->description,
            "duration" => $request->duration,
            "price" => $request->price,
            "date_start" => $request->date_start,
            "date_end" => $request->date_end,
        ]);

        return redirect("/admin");
    }

    public function deleteAdmin(Request $request)
    {
        Course::where("id", $request->id)->delete();
        return redirect("/admin");
    }

    public function addAdmin(Request $request)
    {
        Course::create([
            "name" => $request->name,
            "description" => $request->description,
            "duration" => $request->duration,
            "price" => $request->price,
            "date_start" => $request->date_start,
            "date_end" => $request->date_end,
        ]);

        return redirect("/admin");
    }

    //Api функционал

    public function createSertificate(Request $request){
        $ClientId = $request->header("ClientId");
        $client_id = $request->input("client_id");
        $course_id = $request->input("course_id");

        return response()->json([
            "course_number" => rand(10000, 99999)."1"
        ], 200);
    }

    public function checkSertificate(Request $request){
        $sertikate_number = $request->input("sertikate_number");
        if(substr($sertikate_number, 5) == 2){
            return response()->json([
                "status" => "failed"
            ], 200);
        } else {
            return response()->json([
                "status" => "success"
            ], 200);
        }

    }

    public function apiCourses(Request $request){
        if($request->bearerToken() !== null){
            $token = $request->bearerToken();
        } else {
            return response()->json([
                "message" => "Forbidden for you"
            ], 403);
        };

        $courses = Course::select([
            "id",
            "name",
            "description",
            "duration",
            "price",
            "date_start",
            "date_end",
        ])->paginate(5);

        $formattedData = $courses->map(function ($course) {
            return [
                "id" => $course->id,
                "name" => $course->name,
                "description" => $course->description,
                "duration" => $course->duration,
                "price" => $course->price,
                "date_start" => $course->date_start,
                "date_end" => $course->date_end,
            ];
        })->values();

        return response()->json([
            "data" => $formattedData,
            "pagination" => [
                "total" => $courses->lastPage(),
                "current" => $courses->currentPage(),
                "per_page" => $courses->perPage(),
            ]
        ], 200);
    }

    
}
