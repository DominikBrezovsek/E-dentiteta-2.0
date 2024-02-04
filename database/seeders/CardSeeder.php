<?php

namespace Database\Seeders;

use App\Models\Organisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Card;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $KER = Organisation::where('name', '=', 'Srednja šola za kemijo, elektrotehniko in računalništvo')->select('id')->first();
        $SMP = Organisation::where('name', '=', 'Srednja šola za medijske poklice')->select('id')->first();


        DB::table('cards')->insert([
            'id' => Str::uuid(),
            'id_organisation' => $KER->id,
            'name' => 'Dijaška KER',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'auto_join' => 'Y',
        ]);
        DB::table('cards')->insert([
            'id' => Str::uuid(),
            'id_organisation' => $SMP->id,
            'name' => 'Dijaška SMP',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'auto_join' => 'N',
        ]);
        Card::factory()->count(3)->create();
    }
}
