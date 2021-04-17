<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'name' => "Galatasaray"
        ]);

        DB::table('teams')->insert([
            'name' => "Fenerbahçe"
        ]);

        DB::table('teams')->insert([
            'name' => "Manisaspor"
        ]);

        DB::table('teams')->insert([
            'name' => "Denizlispor"
        ]);
    }
}
