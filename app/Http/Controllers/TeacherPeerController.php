<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class TeacherPeerController extends Controller
{
    public function index()
    {
        $teacher = User::where('role_id', 2)->get();
        return new UserCollection($teacher);
    }
    public function show($id)
    {
        $teacher = User::where('id', $id)->first();

        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $teachers = User::where('role_id', 2)
            ->whereNotIn('id', [$id])
            ->get();

        $evaluatedStudentIds = Evaluation::where('user_id', $id)
            ->whereYear('created_at', date('Y'))
            ->pluck('teacher_id');

        $evalteacher = $teachers->map(function ($student) use ($evaluatedStudentIds) {
            $student->evaluated = $evaluatedStudentIds->contains($student->id) ? 1 : 0;
            return $student;
        });

        return response()->json(['data' => $evalteacher]);
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
