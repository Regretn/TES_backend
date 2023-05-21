<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Evaluation;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class TeacherController extends Controller
{
    public function index()
    {
        return new UserCollection(User::all());
    }

    public function show($id)
    {
        $student = Student::where('student_lrn', $id)->first();

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $users = User::whereHas('sections', function ($query) use ($student) {
            $query->where('section_id', $student->section_id);
        })->get();

        $evaluatedUsers = Evaluation::where('student_id', $student->student_lrn)
            ->whereIn('teacher_id', $users->pluck('id'))
            ->whereYear('created_at', date('Y'))
            ->pluck('teacher_id')
            ->toArray();

        foreach ($users as $user) {
            $user->evaluated = in_array($user->id, $evaluatedUsers) ? 1 : 0;

            if ($user->image) {
                $user->image = asset('images/' . $user->image);
            } else {
                $user->image = asset('images/default.jpg');
            }
        }

        return response()->json(['data' => $users]);
    }




    public function store(Request $request)
    {
        $employee = new User();

        $users = new User;
        $users->teacher_id = $request->teacherId;
        $users->user_name = $request->userName;
        $users->password = $request->password;
        $users->email = $request->email;
        $users->description = $request->description;
        $users->section_id = $request->sectionId;
        $users->role_id = '2';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/teacherFol', $filename);
            $users->image = $filename;
        } else {
            return response()->json(['message' => 'No image file uploaded'])->setStatusCode(400);
        }



        if ($users->save()) {
            return response()->json(['message' => 'Successfully store'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot save users'])->setStatusCode(400);
    }


    public function update(Request $request, $id)
    {
        $users = User::all()->where('id', '=', $id)->first();
        $users->teacher_id = $request->teacherId;
        $users->user_name = $request->userName;
        $users->password = $request->password;
        $users->email = $request->email;
        $users->image = $request->image;
        $users->description = $request->description;
        $users->section_id = $request->sectionId;
        $users->role_id = '2';

        if ($users->save()) {
            return response()->json(['message' => 'Successfully updated'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot update'])->setStatusCode(400);
    }



    public function destroy($id)
    {
        $users = User::all()->where('id', '=', $id)->first();
        if ($users->delete()) {
            return response()->json(['message' => 'User successfully deleted'])->setStatusCode(200);
        }
        return response()->json(['message' => 'User cannot be deleted'])->setStatusCode(200);
    }
}
