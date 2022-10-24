<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;
    protected $table = 'types';

    protected $fillable = ['type_name'];

    public function pokemonTypes(): HasMany
    {
        return $this->hasMany(PokemonType::class, 'type_id', 'id');
    }
}
