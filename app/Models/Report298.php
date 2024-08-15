<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report298 extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function month() {
        return $this->hasOne(Month::class, 'id', 'month_id');
    }

    public function year() {
        return $this->hasOne(Year::class, 'id', 'year_id');
    }
}
