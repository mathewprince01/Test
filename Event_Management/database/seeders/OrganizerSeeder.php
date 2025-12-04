<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('organizers')->insert([
            [
                'name' => 'Tech Event Pvt Ltd',
                    'user_id' => 1,

            ],
            [
                'name' => 'World Expo Org',
                'user_id' => 1,

            ],
        ]);
    }
}
