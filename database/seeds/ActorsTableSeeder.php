<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Columnist;
use App\Intern;
use App\Journalist;
use App\Publisher;
use App\Reporter;
use App\Writer;
use App\Role;
use App\Article;
use App\Administrator;

class ActorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Actors
        $columnist = Columnist::create([]);
        $intern = Intern::create([]);
        $journalist = Journalist::create([]);
        $publisher = Publisher::create([]);
        $reporter = Reporter::create([]);
        $writer = Writer::create([]);
        $writer = Administrator::create([]);

        // Actors Roles
        $administrator_role = Role::where('slug', 'administrador')->first();
        $columnist_role = Role::where('slug', 'colunista')->first();
        $intern_role = Role::where('slug', 'estagiario')->first();
        $journalist_role = Role::where('slug', 'jornalista')->first();
        $publisher_role = Role::where('slug', 'editor')->first();
        $reporter_role = Role::where('slug', 'reporter')->first();
        $writer_role = Role::where('slug', 'escritor')->first();

        factory(User::class, 2)
            ->create()
            ->each(function ($u) use ($publisher, $publisher_role, $administrator_role) {
                $u->userable()->associate($publisher);
                $u->assignRole($u, ['ids' => [$publisher_role->id, $administrator_role->id]]);
                $u->save();
            });

        factory(User::class, 10)
            ->create()
            ->each(function ($u) use ($publisher, $publisher_role) {
                $u->userable()->associate($publisher);
                $u->assignRole($u, ['ids' => $publisher_role->id]);
                $u->save();
                $u->articles()->save(factory(Article::class)->make());
            });

        factory(User::class, 25)
            ->create()
            ->each(function ($u) use ($intern, $intern_role) {
                $u->userable()->associate($intern);
                $u->assignRole($u, ['ids' => $intern_role->id]);
                $u->save();
                $u->articles()->save(factory(Article::class)->make());
            });

        factory(User::class, 100)
            ->create()
            ->each(function ($u) use ($journalist, $journalist_role) {
                $u->userable()->associate($journalist);
                $u->assignRole($u, ['ids' => $journalist_role->id]);
                $u->save();
                $u->articles()->save(factory(Article::class)->make());
            });

        factory(User::class, 120)
            ->create()
            ->each(function ($u) use ($reporter, $reporter_role) {
                $u->userable()->associate($reporter);
                $u->assignRole($u, ['ids' => $reporter_role->id]);
                $u->save();
                $u->articles()->save(factory(Article::class)->make());
            });

        factory(User::class, 5)
            ->create()
            ->each(function ($u) use ($writer, $writer_role) {
                $u->userable()->associate($writer);
                $u->assignRole($u, ['ids' => $writer_role->id]);
                $u->save();
                $u->articles()->save(factory(Article::class)->make());
            });
    }
}
