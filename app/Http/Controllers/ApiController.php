<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllStudent()
    {
        $students = Student::all()->toJson(JSON_PRETTY_PRINT);
        return response($students, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createStudent(Request $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();

        return response()->json([
            "message" => "student created successfully",
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStudent($id)
    {
        if (Student::where('id', $id)->exists()) {
            $student = Student::where('id', $id)->get();
            return response()->json([
                $student,
            ], 201);
        } else {
            return response()->json([
                "message" => "no student present",
            ], 404);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(Request $request, $id)
    {
        if (Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->course = $request->course;
            $student->save();
            return response()->json([
                "message" => "Student updated successfully",
            ], 201);
        } else {
            return \response()->json([
                "message" => "student not found",
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteStudent($id)
    {
        if (Student::where('id', $id)->exists()) {
            Student::where('id', $id)->delete();
            return response()->json([
                "message" => "student deleted successfully",
            ], 201);
        } else {
            return response()->json([
                "message" => "student not found",
            ], 404);
        }
    }
}
