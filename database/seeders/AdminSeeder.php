<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@globalorbitek.co.id',
            'password' => Hash::make('ngetrack'),
            'email_verified_at' => new DateTime(),
        ]);

        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => 'global',
            'personal_team' => true,
        ]);

        $user->current_team_id = $team->id;
        $user->save();

        DB::table('team_user')->insert([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'role' => 'admin'
        ]);
    }
}
