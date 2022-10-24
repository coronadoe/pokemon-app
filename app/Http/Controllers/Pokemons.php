<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class Pokemons extends Controller
{
    public function index(Request $request) {

        $pokemon = Pokemon::query()->paginate(20);

    }


}
