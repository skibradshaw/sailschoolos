<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
        	'firstname' => 'Tim',
        	'lastname' => 'Bradshaw',
        	'email' => 'tim@alltrips.com',
        	'password' => Hash::make('jackass'),
        	'phone' => '3076904269'
        ])->types()->sync([1]);
    }
}
