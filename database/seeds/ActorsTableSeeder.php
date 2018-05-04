<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Columnist;
use App\Intern;
use App\Journalist;
use App\Publisher;
use App\Reporter;
use App\Writer;

class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $columnist = Columnist::create([]);
        $intern = Intern::create([]);
        $journalist = Journalist::create([]);
        $publisher = Publisher::create([]);
        $reporter = Reporter::create([]);
        $writer = Writer::create([]);

        factory(User::class, 5)
            ->create()
            ->each(function ($u) use ($publisher) {
        	   $u->userable()->associate($publisher);
               $u->save();
            });

        factory(User::class, 25)
            ->create()
            ->each(function ($u) use ($intern) {
               $u->userable()->associate($intern);
               $u->save();
            });

        factory(User::class, 100)
            ->create()
            ->each(function ($u) use ($journalist) {
               $u->userable()->associate($journalist);
               $u->save();
            });

        factory(User::class, 120)
            ->create()
            ->each(function ($u) use ($reporter) {
               $u->userable()->associate($reporter);
               $u->save();
            });

        factory(User::class, 5)
            ->create()
            ->each(function ($u) use ($writer) {
               $u->userable()->associate($writer);
               $u->save();
            });
    }
}
