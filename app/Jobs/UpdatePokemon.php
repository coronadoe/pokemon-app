<?php

namespace App\Jobs;

use App\Models\Pokemon;
use App\Models\PokemonType;
use App\Models\Type;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePokemon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pokemon;
    protected $pokemonData;
    protected $pokemonTypes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pokemon $pokemon, array $pokemonData)
    {
        $this->pokemon = $pokemon;
        $this->pokemonData = $pokemonData;
        $this->setPokemonTypes();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->pokemon->update($this->pokemonData);

        collect($this->pokemonTypes)->map(function($pokemonTypeName, $index) {
            $type = Type::firstOrCreate(['type_name' => $pokemonTypeName]);

            $pokemonType = new PokemonType();
            $pokemonType->pokemon_id = $this->pokemon->id;
            $pokemonType->type_id = $type->id;
            $pokemonType->save();
        });
    }

    private function setPokemonTypes() {
        $this->pokemonTypes = $this->pokemonData['types'];
        unset($this->pokemonData['types']);
    }
}
