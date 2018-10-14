<?php

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Service::create(["name" => "Arabic PDF", "points" => 3]);
        \App\Service::create(["name" => "Custom Template", "points" => 5]);
    }
}
