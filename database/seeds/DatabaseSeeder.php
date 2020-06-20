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
        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(BookSeeder::class);
        $this->call(CheckoutSeeder::class);
        $this->call(LikeSeeder::class);
    }
}
