<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatesSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(MeasurementUnitsSeeder::class);
    }
}
