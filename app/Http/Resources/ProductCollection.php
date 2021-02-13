<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
    
            return [
                
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'categorie' => $this->categorie,
                'image_url' => $this->image_url
                
            ];
    
    }
}
