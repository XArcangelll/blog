<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);


        return [
            "id" => $this->id,
            "name" => "Nombre: ".$this->name,
            "slug" => "Slug: ".$this->slug,
            "color" => "Color: ".$this->color,
            "Cantidad" => "No lo sé"
        ];

    }
}
