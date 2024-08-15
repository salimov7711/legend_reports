<?php

namespace App\Http\Resources\mkr_298;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Reports_298_resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image ? url('/storage/' . $this->image) : null,
            'year_id' => $this->year_id,
            'month_id' => $this->month_id,
            'created_at' => $this->created_at,
            'month' => $this->month->month,
            'year' => $this->year->year,
        ];
    }
}
