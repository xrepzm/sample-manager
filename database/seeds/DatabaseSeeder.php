<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use SampleManager\Models\Request;
use SampleManager\Models\Sample;
use SampleManager\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 10)->create();

        factory(Sample::class, 20)->create();

        $faker = Faker::create();

        factory(Request::class, 10)->create()
            ->each(function ($request) use ($faker) {
                $user_id = rand(1, User::count());
                $sample_id = rand(1, Sample::count());
                $quantity = ['quantity' => $faker->randomFloat(3, 1, 3e3)];

                $author = User::where('id', '=', $user_id)->first();
                $sample = Sample::where('id', '>=', $sample_id)->get();

                $request->author()->associate($author);
                $request->save();

                $request->samples()->attach($sample, $quantity);
            });
    }
}
