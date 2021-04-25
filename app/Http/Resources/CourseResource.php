<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\URL;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        static::$wrap='course';

        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'category'       => new  CategoryResource($this['category']),
            'description' => $this['description'],
            'levels' => $this['levels'],
            'rating' => $this['rating'],
            'views' => $this['views'],
            'hours' => $this['hours'],
            'image'      => URL::to('/').'/public/uploads/courses/'.$this['image'],
            'created_at' => (string) $this['created_at'],
        ];
    }
}
