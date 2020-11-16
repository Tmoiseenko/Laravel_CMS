<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
        ]);
        Role::create([
            'name' => 'Post owner',
            'slug' => 'post-owner',
        ]);
    }
}
