<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'meal'=>$this->strMeal,
            'drinkAlternate'=>$this->strDrinkAlternate,
            'category'=> $this->category->strCategory,
            'tags'=> $this->strTags ? explode(',',$this->strTags) : null,
            'area'=> $this->area->area,
            'thumbnail'=>$this->strMealThumb,
            'youtube'=>$this->strYoutube,
            'instructions'=>$this->strInstructions,
            'source'=>$this->strSource,
            'imageSource'=>$this->strImageSource ,
            'mesuarments'=> MeasurementsResource::collection($this->ingredients),
        ];
    }
}
