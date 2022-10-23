<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Support\Collection;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{

    protected $data = [
        'Grass',
        'Poison',
        'Fire',
        'Flying',
        'Dragon',
        'Water',
        'Bug',
        'Normal',
        'Electric',
        'Ground',
        'Fairy',
        'Fighting',
        'Psychic',
        'Rock',
        'Steel',
        'Ice',
        'Ghost',
        'Dark'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->types()->each(function($name, $index) {
            Type::firstOrCreate(['type_name' => $name]);
        });
    }

    protected function types(): Collection 
    {
        return collect($this->data);
    }
}
