<?php
use Faker\Factory as Faker;
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

    $faker = Faker::create();

        foreach(range(1,100) as $index)
        {
            User::create([
                'firstname' => $faker->firstname,
                'lastname' => $faker->lastname,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'state' => $faker->stateAbbr,
                'country' => array_search($faker->country, \CountryState::getCountries())     
            ])->types()->sync([rand(1,6)]);
        }
    }

}
