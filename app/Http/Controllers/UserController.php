<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\SectionUser;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        return new UserCollection(User::all());
    }



    public function show($id)
    {

        $users = User::all()->where('id', '=', $id)->first();
        return new UserResource($users);
    }


    public function store(Request $request)
    {
        $users = new User;
        $users->teacher_id = $request->teacherId;
        $users->user_name = $request->userName;
        $users->password = $request->password;
        $users->email = $request->email;
        $users->image = $request->image;
        $users->description = $request->description;
        $users->role_id = '2';

        if ($users->save()) {
            // handle multiple sections
            $sections = $request->input('sections');
            if ($sections) {
                foreach ($sections as $sectionId) {
                    $SectionUser = new SectionUser;
                    $SectionUser->user_id = $users->id;
                    $SectionUser->section_id = $sectionId;
                    $SectionUser->save();
                }
            }

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