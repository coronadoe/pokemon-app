<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonRequest;
use App\Http\Requests\PokemonUpdateRequest;
use App\Http\Resources\PokemonResource;
use App\Jobs\AddPokemon;
use App\Jobs\DeletePokemon;
use App\Jobs\DeletePokemonTypes;
use App\Jobs\UpdatePokemon;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

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

    public function update(PokemonUpdateRequest $pokemonUpdateRequest, $id) {
        $pokemon = Pokemon::find($id);

        if (empty($pokemon)) {
            return response()->json(['Failed' => 'Pokemon was not Found']);
        }

        if ($pokemonUpdateRequest->validated()) {

            Bus::chain([
                new DeletePokemonTypes($pokemon),
                new UpdatePokemon($pokemon, $pokemonUpdateRequest->all()),
            ])->dispatch();

            return response()->json(['Success' => 'Pokemon was updated']);
        }
    }

    public function destroy(Request $request, $id) {
        $pokemon = Pokemon::find($id);

        if (empty($pokemon)) {
            return response()->json(['Failed' => 'Pokemon was not Found']);
        }

        Bus::chain([
            new DeletePokemonTypes($pokemon),
            new DeletePokemon($pokemon),
        ])->dispatch();

        return response()->json(['Success' => "Pokemon was Deleted Successfully"]);
    }

}
