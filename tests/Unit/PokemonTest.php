<?php

namespace Tests\Unit;

use App\Jobs\AddPokemon;
use App\Jobs\DeletePokemon;
use App\Jobs\UpdatePokemon;
use App\Models\Pokemon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PokemonTest extends TestCase
{

    protected $pokemonTable = 'pokemons';

    public function test_it_inserts_a_pokemon_in_the_database()
    {
        $pokemon = [
            'name' => 'New Pokemon Name',
            'total' => 1,
            'hp' => 1,
            'attack' => 1,
            'defence' => 1,
            'special_attack' => 1,
            'special_defence' => 1,
            'speed' => 1,
            'generation' => 1,
            'legendary'=> 1,
            'types' => [
                'type 1',
                'type 2'
            ]
        ];

        $addPokemon = new AddPokemon($pokemon);
        $addPokemon->handle();

        unset($pokemon['types']);

        $this->assertDatabaseHas('pokemons', $pokemon);
    }

    public function test_it_update_a_pokemon_entry_in_the_database() {
        $updateValues = [
            'total' => 20,
            'hp' => 10,
            'attack' => 0,
            'defence' => 100,
            'special_attack' => 100,
            'special_defence' => 90,
            'speed' => 15,
            'generation' => 1,
            'legendary'=> false,
            'types' => [
                'grass',
                'fairy'
            ]
        ];

        $pokemon = Pokemon::orderBy('id', 'desc')->first();

        $updatePokemon = new UpdatePokemon($pokemon, $updateValues);
        $updatePokemon->handle();

        unset($updateValues['types']);

        $this->assertDatabaseHas($this->pokemonTable, $updateValues);
    }

    public function test_it_removes_a_pokemon_entry_from_the_database() {
        $pokemon = Pokemon::orderBy('id', 'desc')->first();

        $deletePokemon = new DeletePokemon($pokemon);
        $deletePokemon->handle();

        $this->assertDeleted($this->pokemonTable, ['id' => $pokemon->id]);
    }

}
