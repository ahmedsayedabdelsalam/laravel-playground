<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Project;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)
            ->create()
            ->each(function($user) {
                $user->projects()->saveMany(factory(Project::class, rand(1, 3))->make());
            });

//        factory(Project::class, 10)->create();
    }
}
