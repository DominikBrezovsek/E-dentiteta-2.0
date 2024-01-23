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
        $user1 = User::where('username', '=', 'zskorja')->select('id')->first();
        $user2 = User::where('username', '=', 'nmejacina')->select('id')->first();
        $user3 = User::where('username', '=', 'dbreza')->select('id')->first();

        DB::table('organisations')->insert([
            'id' => Str::uuid(),
            'name' => 'Srednja šola za kemijo, elektrotehniko in računalništvo',
            'verified' => 'Y',
            'checkking_all_cards' => 'Y',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'id_user' => $user1->id,
        ]);
        DB::table('organisations')->insert([
            'id' => Str::uuid(),
            'name' => 'Srednja šola za strojništvo',
            'verified' => 'Y',
            'checkking_all_cards' => 'N',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'id_user' => $user2->id,
        ]);
        DB::table('organisations')->insert([
            'id' => Str::uuid(),
            'name' => 'Srednja šola za medijske poklice',
            'verified' => 'N',
            'checkking_all_cards' => 'N',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'id_user' => $user3->id,
        ]);
        Organisation::factory()->count(7)->create();
    }
}
