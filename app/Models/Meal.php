<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('measurement')->withTimestamps();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }
}