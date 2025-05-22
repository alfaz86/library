<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Setting;

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::set('library_name', 'Perpustakaan Umum');
        Setting::set('library_logo', '/assets/logo.png');
        Setting::set('loan_duration_days', '7');
        Setting::set('fine_per_day', '500');
    }
}
