<?php

use App\Comment;
use App\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Feature::class, 100)->create()->each(
            fn ($feature) => factory(Comment::class, 20)->create([
                'feature_id' => $feature->id
            ])
        );
    }
}
