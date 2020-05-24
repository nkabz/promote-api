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
        factory('App\User', 5)->create();
        factory('App\Post', 10)->create();
        factory('App\Comment', 20)->create();
        factory('App\Transaction', 5)->create();
    }
}
