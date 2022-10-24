<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonRequest;
use App\Http\Resources\PokemonResource;
use App\Jobs\AddPokemon;
use App\Models\Pokemon;
use Illuminate\Http\Request;

class Pokemons extends Controller
{
    public function index(Request $request) {
        $pageSize = $request->page_size ?? 10;
        $pokemons = PokemonResource::collection(Pokemon::query()->paginate($pageSize));
        return response()->json(['pokemons' => $pokemons]);
    }

    public function show(Request $request, $id)
    {
        $pokemon = PokemonResource::make(Pokemon::find($id));
        if (!empty($pokemon)) {
            return response()->json(['pokemon' => $pokemon]);
        }

        return response()->json(['pokemon' => "No product found"]);
    }

    public function store(PokemonRequest $pokemonRequest) {

        if ($pokemonRequest->validated()) {
            dispatch(new AddPokemon($pokemonRequest->all()));
            return response()->json(['Success' => 'Pokemon was Added Successfully']);
        }

        return response()->json(['Failed' => 'Pokemon was not Added']);

    }

}
