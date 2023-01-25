<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'title' => 'comprar',
            'description' => 'patatas, cebollas'
        ]);

        DB::table('tasks')->insert([
            'title' => 'vender',
            'description' => 'patatas, cebollas',
            'status' => true
        ]);

        DB::table('tasks')->insert([
            'title' => 'comprar',
            'description' => 'patatas, cebollas'
        ]);

        DB::table('tasks')->insert([
            'title' => 'recoger',
            'description' => 'patatas, cebollas',
            'status' => true
        ]);
    }
}
