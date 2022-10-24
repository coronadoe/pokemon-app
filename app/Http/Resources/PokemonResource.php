<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PokemonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $pokemonTypes = $this->pokemonTypes->map(function($pokemonType) {
            return $pokemonType->type->type_name;
        });

        return [
            "id" => $this->id,
            "name" => $this->name,
            "total" => $this->total,
            "hp" => $this->hp,
            "attack" => $this->attack,
            "defence" => $this->defence,
            "special_attack" => $this->special_attack,
            "special_defence" => $this->special_defence,
            "speed" => $this->speed,
            "generation" => $this->generation,
            "legendary" => $this->legendary,
            "types" => $pokemonTypes->toArray(),
        ];
    }
}
