<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Card;
use App\Models\Classes;
use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use App\Models\Students;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userSeeder = new UserSeeder();
        $userSeeder->run();
        $organisationSeeder = new OrganisationSeeder();
        $organisationSeeder->run();
        $cardSeeder = new CardSeeder();
        $cardSeeder->run();

        $user1 = User::where('username', '=', 'dbreza')->first();
        $user2 = User::where('username', '=', 'resinovicbost')->first();
        $user3 = User::where('username', '=', 'nmejacina')->first();
        $oid = Organisation::where('name', '=', 'Srednja šola za kemijo, elektrotehniko in računalništvo')->first();
        OrganisationAdmin::insert([
            'id_admin' => Str::uuid(),
            'id_user' => $user1->id,
            'id_organisation' => $oid->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $organisationAdmin = OrganisationAdmin::whereIdUser($user1->id)->first();

        Teacher::insert([
            'id' => Str::uuid(),
            'id_user' => $user2->id,
            'id_organisation' => $oid->id,
            'verified_by' => $organisationAdmin->id_admin,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $classesSeeder = new ClassSeeder();
        $classesSeeder->run();

        $r4b = Classes::where('name', '=', 'R4B')->first();

        Students::insert([
            'id' => Str::uuid(),
            'id_user' => $user3->id,
            'id_organisation' => $oid->id,
            'id_class' => $r4b->id,
            'verified_by' => $organisationAdmin->id_admin,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        $users = User::where('role', 'USR')->limit(20)->get();
        foreach ($users as $user) {
            Students::insert([
                'id' => Str::uuid(),
                'id_user' => $user->id,
                'id_organisation' => $oid->id,
                'id_class' => $r4b->id,
                'verified_by' => $organisationAdmin->id_admin,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
