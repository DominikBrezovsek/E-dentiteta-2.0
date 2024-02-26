<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Card;
use App\Models\Organisation as Organsiation;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cards')->insert([
            'id' => Str::uuid(),
            'id_organisation' => Organsiation::where('name', '=', 'Srednja šola za kemijo, elektrotehniko in računalništvo')->first()->id,
            'name' => 'Dijaška KER',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'auto_join' => 'Y',
        ]);
        DB::table('cards')->insert([
            'id' => Str::uuid(),
            'id_organisation' => Organsiation::where('name', '=', 'Srednja šola za medijske poklice')->first()->id,
            'name' => 'Dijaška SMP',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'auto_join' => 'N',
        ]);
        Card::factory()->count(3)->create();
    }
}
