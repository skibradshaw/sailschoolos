<?php

use Illuminate\Database\Seeder;
use App\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        UserType::create(['name' => 'Contact']);
        UserType::create(['name' => 'Student']);
        UserType::create(['name' => 'Employee']);
        UserType::create(['name' => 'Buyer']);
        UserType::create(['name' => 'Seller']);
        UserType::create(['name' => 'Charter Guest']);
    }
}
