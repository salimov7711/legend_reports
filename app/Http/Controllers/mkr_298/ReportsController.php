<?php

namespace App\Http\Controllers\mkr_298;

use App\Http\Controllers\Controller;
use App\Http\Requests\mkr_298\CreateReportRequest;
use App\Http\Requests\mkr_298\UpdateReportRequest;
use App\Http\Resources\mkr_298\Reports_298_resource;
use App\Models\Report298;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = Reports_298_resource::collection(Report298::all());

        return $reports;
    }

    public function show(Report298 $report298)
    {
        return $report298;
    }

    public function store(CreateReportRequest $request)
    {

        $image = $request->file('image');

        $imagePath = $image->store('images/mkr_298');

        $report = new Report298();
        $report->title = $request->title;
        $report->image = $imagePath;
        $report->year_id = $request->year_id;
        $report->month_id = $request->month_id;
        $report->order = $request->order;
        $report->save();
        return response()->json(['message' => 'created successfully'], 201);
    }

    public function update(UpdateReportRequest $request, Report298 $report298)
    {
        $report298->title = $request->title == 'null' ? null : $request->title;
        $image = $report298->image;
        if ($request->hasFile('image')) {
            if ($image) {
                Storage::delete($report298->image);
            }
            $report298->image = $request->file('image')->store('images/mkr_298');
        }

        $report298->year_id = $request->year_id;
        $report298->month_id = $request->month_id;
        $report298->order = $request->order;
        $report298->save();
        return response()->json(['message' => 'updated successfully'], 200);
    }

    public function delete(Report298 $report298)
    {
        if ($report298->image != null) {
            Storage::delete($report298->image);
        }

        $report298->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
    }

    public function allReports()
    {
        return Reports_298_resource::collection(Report298::all());
    }

}

