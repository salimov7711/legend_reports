<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportStoreRequest;
use App\Http\Requests\ReportUpdateRequest;
use App\Http\Resources\GetReportItemResource;
use App\Http\Resources\ReportsItemResource;
use App\Http\Resources\ReportsResource;
use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{

    public function index()
    {
        $reports = Category::query()->with('reports')->get();
        return ReportsResource::collection($reports);
    }

    public function getUser(Request $request) {
        $user = Auth::user();
        return  $user;
    }
    public function getAllReports(Request $request)
    {
        $reports = Report::all();
        return ReportsItemResource::collection($reports);
    }

    public function show(Report $report) {
//        return $report;
        return GetReportItemResource::make($report);
    }
    public function getReportsByCategory(Category $category)
    {
        return ReportsItemResource::collection($category->reports);
    }

    public function store(ReportStoreRequest $request)
    {



            $image = $request->file("image");
            if ($image) {
                $imagePath = $image->store('images/real-estates');
            } else {
                $imagePath = null;
            }
            $report = new Report();
            $report->title = $request['title'];
            $report->image = $imagePath;
            $report->category_id = $request['category_id'];
            $report->save();

        return response()->json(['messages' => 'report created successfully']);
    }

    public function delete(Report $report)
    {




            if ($report->image != null) {
                Storage::delete($report->image);

            }
            $report->delete();

        return response()->json(['message' => 'deleted successfully']);
    }

    public function update(ReportUpdateRequest $request, Report $report)
    {
        $report->title = $request->input('title');
        $image = $report->image;
        if ($request->hasFile('image')) {
            if ($image) {
                Storage::delete($report->image);
            }
            $report->image = $request->file('image')->store('images/real-estates');
        }


        $report->category_id = $request->input('category_id');
        $report->order = $request->input('order');
        $report->save();

        return response()->json(['message' => 'updated successfully'], 201);
    }

}
