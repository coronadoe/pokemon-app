<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemons';

    protected $fillable = [
        'name',
        'total',
        'hp',
        'attack',
        'defence',
        'special_attack',
        'special_defence',
        'speed',
        'generation',
        'legendary',
    ];

    public function pokemonTypes(): HasMany
    {
        return $this->hasMany(PokemonType::class, 'pokemon_id', 'id');
    }
}
