<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Žan',
            'surname' => 'Škorja',
            'email' => 'zan.skorja@gmail.com',
            'username' => 'zskorja',
            'password' => Hash::make('Default00'),
            'role' => 'ADM',
            'emso' => '0409005500058',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Dominik',
            'surname' => 'Brezovšek',
            'email' => 'dominikbe25@gmail.com',
            'username' => 'dbreza',
            'password' => Hash::make('Default00'),
            'role' => 'ORG',
            'emso' => '0209005500058',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Nik',
            'surname' => 'Mejak',
            'email' => 'mejaknik@gmail.com',
            'username' => 'nmejacina',
            'password' => Hash::make('Default00'),
            'role' => 'USR',
            'emso' => '0604005500058',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]); 
        
        User::factory()->count(97)->create();

    }
}
