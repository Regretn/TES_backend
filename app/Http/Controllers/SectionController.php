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
        $sections = Section::all()->sortBy(function ($section) {
            return intval(explode('-', $section->section_name)[0]);
        })->values();

        return response()->json(['data' => $sections]);
    }


    public function show($id)
    {
        $section = Section::find($id);
        return new SectionResource($section);
    }

    public function store(Request $request)
    {
        $section = new Section();
        $section->section_name = $request->section_name;

        if ($section->save()) {
            return response()->json(['message' => 'Successfully stored'])->setStatusCode(200);
        }

        return response()->json(['message' => 'Error, cannot save section'])->setStatusCode(400);
    }

    public function update(Request $request, $id)
    {
        $section = Section::find($id);
        $section->section_name = $request->section_name;

        if ($section->save()) {
            return response()->json(['message' => 'Successfully updated'])->setStatusCode(200);
        }

        return response()->json(['message' => 'Error, cannot update section'])->setStatusCode(400);
    }

    public function destroy($id)
    {
        $section = Section::find($id);

        if ($section->delete()) {
            return response()->json(['message' => 'Successfully deleted'])->setStatusCode(200);
        }

        return response()->json(['message' => 'Error, cannot delete section'])->setStatusCode(400);
    }
}
