<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;
    protected  static function booted()
    {
        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderByRaw("FIELD(month, 'январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь')");
        });
    }

    protected $guarded = ['id'];
}
