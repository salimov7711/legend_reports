<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportStoreRequest;
use App\Http\Resources\ReportsItemResource;
use App\Http\Resources\ReportsResource;
use App\Models\Category;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{

    public function index() {
        $reports =  Category::query()->with('reports')->get();
        return ReportsResource::collection($reports);
    }

    public function getReportsByCategory(Category $category)
    {
        return ReportsItemResource::collection($category->reports) ;
    }

    public function store(ReportStoreRequest $request)
    {
        $items = collect($request->input('items'));

        $items->each(function ($item, $key) use ($request) {

            $image = $request->file("items.$key.image");
            if ($image) {
                $imagePath = $image->store('images/real-estates');
            } else {
                $imagePath = null;
            }
            $report = new Report();
            $report->title = $item['title'];
            $report->image = $imagePath;
            $report->category_id = $item['category_id'];
            $report->save();
        });

        return response()->json(['messages' => 'reports created successfully']);
    }

    public function delete(Request $request) {
       $request->validate([
           'ids' => 'nullable|array',
           'ids.*' =>'numeric'
       ]);

        $ids = $request->input('ids', []);
        $reports = Report::query()->whereIn('id',$ids)->get();
         $reports->each(function($report) {
             if($report->image  != null) {
                 Storage::delete($report->image);

             }
             $report->delete();
         });

         return response()->json(['message' => 'deleted successfully']);
    }

}
