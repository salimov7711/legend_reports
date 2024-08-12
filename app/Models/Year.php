<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Year extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope('ordered', function (Builder $builder){
            $builder->orderBy('year', 'asc');
        });
    }

    protected $guarded = ['id'];
}
