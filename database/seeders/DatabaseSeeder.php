<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Book\Database\Seeders\BookDatabaseSeeder;
use Modules\Core\Database\Seeders\CoreDatabaseSeeder;
use Modules\Fines\Database\Seeders\FinesDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CoreDatabaseSeeder::class,
            BookDatabaseSeeder::class,
            FinesDatabaseSeeder::class,
        ]);
    }
}
