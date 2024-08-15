<?php

namespace App\Http\Controllers\mkr_298;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;

class YearsController extends Controller
{
    public function index()
    {
        return Year::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric|unique:years|max:2040'
        ]);

        $year = Year::query()->create([
            'year' => $request->year
        ]);

        return response()->json(['message' => 'created successfully'], 200);

    }

    public function delete(Year $year)
    {
        $year->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }

    public function update(Request $request, Year $year) {
        $request->validate([
            'year' => 'required|numeric|unique:years|max:2040'
        ]);
        $year->year = $request->year;
        $year->save();
        return response()->json(['message' => 'updated successfully'], 200);
    }

    public function show(Year $year) {
        return $year;
    }
}
