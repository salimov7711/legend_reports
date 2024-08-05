<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'reports' => $this->reports->map(function ($report) {
                    return [
                        'id' => $report->id,
                        'title' => $report->title,
                        'image' => $report->image ? url( 'storage/'. $report->image) : null,
                        'order' => $report->order
                    ];
                })


        ];
    }
}
