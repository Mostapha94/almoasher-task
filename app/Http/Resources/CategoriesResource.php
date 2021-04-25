<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        static::$wrap='categories';

        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'created_at' => (string) $this['created_at'],
        ];
    }
}
