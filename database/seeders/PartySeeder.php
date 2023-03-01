<?php

namespace Database\Seeders;

use App\Models\Party;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('parties')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = collect(config('constants.parties'));

        $data->each(fn ($name) => Party::create(['name' => $name, 'icon' => "{$name}.png"]));
    }
}
