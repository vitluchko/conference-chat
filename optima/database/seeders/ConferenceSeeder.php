<?php

namespace Database\Seeders;

use App\Models\Conference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conference::create([
            'title' => 'First Conference',
            'start_date' => '2024-07-08',
            'end_date' => '2024-07-08',
            'isActive' => true,
            'description' => 'It\'s your first conference.', 
        ]);
    }
}
