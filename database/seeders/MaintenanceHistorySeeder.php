<?php

namespace Database\Seeders;

use App\Models\MaintenanceHistory;
use Illuminate\Database\Seeder;

class MaintenanceHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaintenanceHistory::factory()->count(5)->create();
    }
}
