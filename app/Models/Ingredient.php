<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function meals()
    {
        return $this->belongsToMany(Meal::class)->withPivot('active', 'created_by');
    }
}