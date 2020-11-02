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
        $manager = new Role();
        $manager->name = 'Administrator';
        $manager->slug = 'admin';
        $manager->save();
        $developer = new Role();
        $developer->name = 'Post owner';
        $developer->slug = 'post-owner';
        $developer->save();
    }
}
