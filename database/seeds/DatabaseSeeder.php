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
        factory('App\User', 15)->create();
        factory('App\Post', 15)->create();
        $this->factoryWithoutObservers('App\Comment', 300)->create();
        factory('App\Transaction', 10)->create();
    }

    public function factoryWithoutObservers($class, $amount = 1) {
        $class::flushEventListeners();
        return factory($class, $amount);
    }
}
