<?php

namespace App\Http\Controllers;

use App\Http\Resources\PokemonResource;
use App\Models\Pokemon;
use Illuminate\Http\Request;

class Pokemons extends Controller
{
    public function index(Request $request) {
        $pageSize = $request->page_size ?? 10;
        $pokemons = PokemonResource::collection(Pokemon::query()->paginate($pageSize));
        return response()->json(['pokemons' => $pokemons]);
    }

}
