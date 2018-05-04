<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'jornalista']);
        Role::create(['name' => 'colunista']);
        Role::create(['name' => 'estagiario']);
        Role::create(['name' => 'reporter']);
        Role::create(['name' => 'escritor']);
    }
}
