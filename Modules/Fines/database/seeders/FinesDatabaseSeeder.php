<?php

namespace Modules\Fines\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Core\Models\Setting;

class FinesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keys = [
            'fines::fine_amount',
            'fines::fine_interval',
            'fines::fine_type',
            'fines::max_days',
        ];
        $existingKeys = DB::table('settings')->whereIn('key', $keys)->pluck('key')->toArray();
        if (count($existingKeys) !== count($keys)) {
            Setting::set('fines::fine_amount', '1000');
            Setting::set('fines::fine_interval', 'day');
            Setting::set('fines::fine_type', 'per_item');
            Setting::set('fines::max_days', '7');
        }

        $this->call([
            // calculate fine amount in loan_returns when returned isLate
            CalculateFineAmountInLoanReturnsSeeder::class,
        ]);
    }
}
