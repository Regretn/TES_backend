<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return new RoleCollection(Role::all());
    }

    public function show($id)
    {
        $orders = Role::all()->where('id', '=', $id)->first();
        // return new RoleResource($orders);
        return $orders;
    }


    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {

        $role = Role::all()->where('id', '=', $id)->first();
        $role->user_type = $request->roleTypes;

        if ($role->save()) {
            return response()->json(['message' => 'Successfully save'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot update Section'])->setStatusCode(400);
    }

    public function store(Request $request)
    {
        $role = new Role();
        $role->id = $request->id;
        $role->user_type = $request->userType;


        if ($role->save()) {
            return response()->json(['message' => 'Successfully store'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot save users'])->setStatusCode(400);
    }



    public function destroy($id)
    {
    }
}
