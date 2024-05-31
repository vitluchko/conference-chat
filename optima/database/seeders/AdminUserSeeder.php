<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
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
            'email' => 'optima.conference.kpnu@gmail.com',
            'password' => bcrypt('11111111'),
            'role_id' => 2,
        ]);

        Profile::create(['user_id' => $user->id]);
    }
}
