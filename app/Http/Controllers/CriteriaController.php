<?php

namespace App\Http\Controllers;

use App\Http\Resources\Criteria2Collection;
use App\Http\Resources\CriteriaResource;
use Illuminate\Http\Request;
use App\Models\Criteria;

class CriteriaController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();

        return new Criteria2Collection($criterias);
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria_name' => 'required|string|max:255',
        ]);

        $criteria = Criteria::create([
            'criteria_name' => $request->criteria_name,
        ]);

        return response()->json($criteria, 201);
    }

    public function show($id)
    {
        $criteria = Criteria::find($id);

        if (!$criteria) {
            return response()->json(['message' => 'Criteria not found'], 404);
        }

        return new CriteriaResource($criteria);
    }
    public function update(Request $request)
    {
        $request->validate([
            'criteria' => 'required|array',
            'criteria.*.id' => 'required|exists:criterias,id',
            'criteria.*.criteria_name' => 'required|string|max:255',
        ]);

        $updatedCriteria = [];

        foreach ($request->criteria as $item) {
            $criteria = Criteria::find($item['id']);

            if (!$criteria) {
                return response()->json(['message' => 'Criteria not found'], 404);
            }

            $criteria->update([
                'criteria_name' => $item['criteria_name'],
            ]);

            $updatedCriteria[] = $criteria;
        }

        return response()->json($updatedCriteria);
    }




    public function destroy($id)
    {
        $criteria = Criteria::find($id);

        if (!$criteria) {
            return response()->json(['message' => 'Criteria not found'], 404);
        }

        $criteria->delete();

        return response()->json(['message' => 'Criteria deleted']);
    }
}
