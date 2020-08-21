<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /** @var string */
    private const USER_PASSWORD = 'P@ssw0rd';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make(self::USER_PASSWORD),
            'image' => Illuminate\Support\Str::random(64),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $Faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $Faker->firstName,
                'email' => $Faker->unique()->safeEmail,
                'password' => Illuminate\Support\Facades\Hash::make(Illuminate\Support\Str::random(rand(0, 255))),
                'image' => Illuminate\Support\Str::random(64),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
