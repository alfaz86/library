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
        Setting::set('app::name', 'Perpustakaan Umum');
        Setting::set('app::logo', asset('images/book.png'));
        Setting::set('logger::is_active', '1');
    }
}
