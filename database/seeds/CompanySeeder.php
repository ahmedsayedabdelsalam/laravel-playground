<?php

use App\Company;
use App\Login;
use App\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Company::class, 1000)->create()->each(
            fn ($company) => factory(User::class, 50)->create([
                'company_id' => $company->id
            ])->when(
                $company->id < 2,
                fn ($users) => $users->each(
                    fn ($user) => factory(Login::class, 100)->create([
                        'user_id' => $user->id
                    ])
                )
            )
        );
    }
}
