<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetReportItemResource extends JsonResource
{   public static $wrap = false;
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
            'image'=> $this->image ? url('storage/' . $this['image']) : null,
            'category' => $this->category,
            'category_id' => $this->category_id,
            'order' => $this->order
        ];
    }
}
