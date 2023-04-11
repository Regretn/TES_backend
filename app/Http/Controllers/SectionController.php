<?php

namespace App\Http\Controllers;

use App\Http\Resources\SectionCollection;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        return new SectionCollection(Section::all());
    }



    public function show($id)
    {
        $section = Section::all()->where('id', '=', $id)->first();
        return new SectionResource($section);
    }


    public function store(Request $request)
    {
        $section = new Section();
        $section->id = $request->id;
        $section->section_name = $request->sectionName;


        if ($section->save()) {
            return response()->json(['message' => 'Successfully store'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot save users'])->setStatusCode(400);
    }


    public function update(Request $request, $id)
    {

        $section = Section::all()->where('id', '=', $id)->first();
        $section->section_name = $request->sectionName;

        if ($section->save()) {
            return response()->json(['message' => 'Successfully save'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot update Section'])->setStatusCode(400);
    }



    public function destroy($id)
    {
        $section = Section::all()->where('id', '=', $id)->first();
        if ($section->delete()) {
            return response()->json(['message' => 'Successfully deleted'])->setStatusCode(200);
        }
        return response()->json(['message' => 'Error, cannot delete Section'])->setStatusCode(400);
    }
}
