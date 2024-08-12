<?php

namespace App\Http\Controllers\mkr_298;

use App\Http\Controllers\Controller;
use App\Models\Month;
use Illuminate\Http\Request;

class MonthsController extends Controller
{
    public function index()
    {
        return Month::all();
    }

    public function show(Month $month)
    {
        return $month;
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|string|unique:months|max:20'

        ]);

        $month = Month::query()->create([
            'month' => $request->month
        ]);

        return response()->json(['message' => 'created successfully'], 201);

    }

    public function delete(Month $month)
    {
        $month->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }

    public function update(Request $request, Month $month)
    {
        $request->validate([
            'month' => 'required|string|unique:months|max:20'
        ]);

        $month->month = $request->month;
        $month->save();
        return response()->json(['message'=> 'updated successfully'],200);
    }


}
