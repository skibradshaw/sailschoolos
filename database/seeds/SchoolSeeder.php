<?php

use Illuminate\Database\Seeder;
use App\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        School::create([
        	'name' => 'LTD Sailing',
        	'logo' => 'images/logo.png'
        	]);
    }
}
