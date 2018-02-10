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
        ])->types()->sync([3,1]);

        User::create([
            'firstname' => 'Chris',
            'lastname' => 'Rundlett',
            'email' => 'chris@ltdsailing.com',
            'password' => Hash::make('secret'),
            'phone' => '2069727245'
        ])->types()->sync([3]);

        User::create([
            'firstname' => 'Chrystal',
            'lastname' => 'Young',
            'email' => 'chrystal@ltdsailing.com',
            'password' => Hash::make('secret'),
            'phone' => '2069727245'
        ])->types()->sync([3]);
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            User::create([
                'firstname' => $faker->firstname,
                'lastname' => $faker->lastname,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'state' => $faker->stateAbbr,
                'country' => array_search($faker->country, \CountryState::getCountries())
            ])->types()->sync([1,rand(2, 6)]);
        }
    }
}
