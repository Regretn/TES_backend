<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return new StudentCollection(Student::all());
    }


    public function show($id)
    {
        $student = Student::find($id);
        return new StudentResource($student);
    }


    public function update(Request $request, $id)
    {
        $student = Student::all()->where('id', '=', $id)->first();
        $student->student_lrn = $request->studentLrn;
        $student->section_id = $request->sectionId;
        $student->section_name = $request->sectionName;

        if ($student->save()) {
            return response()->json(['message' => 'Successfully save'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot update Student'])->setStatusCode(400);
    }

    public function store(Request $request)
    {
        $student = new Student();
        $student->student_lrn = $request->studentLrn;
        $student->section_id = $request->sectionId;
        $student->section_name = $request->sectionName;



        if ($student->save()) {
            return response()->json(['message' => 'Successfully store'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot save users'])->setStatusCode(400);
    }



    public function destroy($id)
    {
        $student = Student::all()->where('id', '=', $id)->first();
        if ($student->delete()) {
            return response()->json(['message' => 'Successfully Deleted!'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot delete'])->setStatusCode(400);
    }
}
