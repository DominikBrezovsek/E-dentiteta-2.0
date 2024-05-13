<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Classes;
use App\Models\Organisation;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $oid = Organisation::where('name', '=', 'Srednja šola za kemijo, elektrotehniko in računalništvo')->first();
        $user2 = User::where('username', '=', 'resinovicbost')->select('id')->first();
        $teacher = Teacher::whereIdUser($user2->id)->first();
        $card = Card::where('name', '=', 'Dijaška KER')->first();

        Classes::insert([
            'id' => Str::uuid(),
            'name' => 'R4B',
            'id_organisation' => $oid->id,
            'id_teacher' => $teacher->id,
            'id_card' => $card->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Classes::insert([
            'id' => Str::uuid(),
            'name' => 'R4A',
            'id_organisation' => $oid->id,
            'id_teacher' => $teacher->id,
            'id_card' => $card->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        Classes::insert([
            'id' => Str::uuid(),
            'name' => 'R3A',
            'id_organisation' => $oid->id,
            'id_teacher' => $teacher->id,
            'id_card' => $card->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Classes::insert([
            'id' => Str::uuid(),
            'name' => 'R3B',
            'id_organisation' => $oid->id,
            'id_teacher' => $teacher->id,
            'id_card' => $card->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Classes::insert([
            'id' => Str::uuid(),
            'name' => 'R2A',
            'id_organisation' => $oid->id,
            'id_teacher' => $teacher->id,
            'id_card' => $card->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Classes::insert([
            'id' => Str::uuid(),
            'name' => 'R2B',
            'id_organisation' => $oid->id,
            'id_teacher' => $teacher->id,
            'id_card' => $card->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Classes::insert([
            'id' => Str::uuid(),
            'name' => 'R1A',
            'id_organisation' => $oid->id,
            'id_teacher' => $teacher->id,
            'id_card' => $card->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        Classes::insert([
            'id' => Str::uuid(),
            'name' => 'R1B',
            'id_organisation' => $oid->id,
            'id_teacher' => $teacher->id,
            'id_card' => $card->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
