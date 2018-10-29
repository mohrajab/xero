<?php

use Illuminate\Database\Seeder;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Artisan::call('passport:install');
        \Illuminate\Support\Facades\Artisan::call('php artisan passport:client');
    }
}
