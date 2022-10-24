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

class AddPokemon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pokemonValues = [];
    protected $pokemonTypes = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $pokemonValues)
    {
        $this->pokemonValues = $pokemonValues;
        $this->setPokemonTypes();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pokemon = Pokemon::create($this->pokemonValues);
        collect($this->pokemonTypes)->map(function($pokemonTypeName, $index) use ($pokemon) {
            $type = Type::firstOrCreate(['type_name' => $pokemonTypeName]);

            $pokemonType = new PokemonType();
            $pokemonType->pokemon_id = $pokemon->id;
            $pokemonType->type_id = $type->id;
            $pokemonType->save();

            // PokemonType::create([
            //     'pokemon_id' => ,
            //     'type_id' => 
            // ]);
        });
    }

    private function setPokemonTypes() {
        $this->pokemonTypes = $this->pokemonValues['types'];
        unset($this->pokemonValues['types']);
    }
}
