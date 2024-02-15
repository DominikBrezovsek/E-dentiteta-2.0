<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\User;
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
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('organisations')->insert([
            'id' => Str::uuid(),
            'name' => 'Srednja šola za strojništvo',
            'verified' => 'Y',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('organisations')->insert([
            'id' => Str::uuid(),
            'name' => 'Srednja šola za medijske poklice',
            'verified' => 'N',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        Organisation::factory()->count(7)->create();
    }
}
