<?php

namespace Database\Seeders;

use App\Models\Organisation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('organisations')->insert([
            'id' => Str::uuid(),
            'name' => 'Srednja šola za kemijo, elektrotehniko in računalništvo',
            'verified' => 'Y',
            'checkking_all_cards' => 'Y',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'id_user' => 'c95235f0-3000-42ee-b937-8033708924a1',
        ]);
        DB::table('organisations')->insert([
            'id' => Str::uuid(),
            'name' => 'Srednja šola za strojništvo',
            'verified' => 'Y',
            'checkking_all_cards' => 'N',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'id_user' => 'c95235f0-3000-42ee-b937-8033708924a1',
        ]);
        DB::table('organisations')->insert([
            'id' => Str::uuid(),
            'name' => 'Srednja šola za medijske poklice',
            'verified' => 'N',
            'checkking_all_cards' => 'N',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'id_user' => 'c95235f0-3000-42ee-b937-8033708924a1',
        ]);
        Organisation::factory()->count(7)->create();
    }
}
