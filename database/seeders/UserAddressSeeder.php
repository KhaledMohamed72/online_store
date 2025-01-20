<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $faker = Factory::create();

        $sami   = User::whereUsername('sami')->first();
        $ksa   = Country::with('states')->whereId(194)->first();
        $state = $ksa->states->random()->id;
        $city = City::whereStateId($state)->inRandomOrder()->first()->id;

        $sami->addresses()->create([
            'address_title'         => 'Home',
            'default_address'       => true,
            'first_name'            => 'Sami',
            'last_name'             => 'Mansour',
            'email'                 => $faker->email,
            'mobile'                => $faker->phoneNumber,
            'address'               => $faker->address,
            'address2'              => $faker->secondaryAddress,
            'country_id'            => $ksa->id,
            'state_id'              => $state,
            'city_id'               => $city,
            'zip_code'              => $faker->randomNumber(5),
            'po_box'                => $faker->randomNumber(4),
        ]);


        $sami->addresses()->create([
            'address_title'         => 'Work',
            'default_address'       => false,
            'first_name'            => 'Sami',
            'last_name'             => 'Mansour',
            'email'                 => $faker->email,
            'mobile'                => $faker->phoneNumber,
            'address'               => $faker->address,
            'address2'              => $faker->secondaryAddress,
            'country_id'            => 65,
            'state_id'              => 3223,
            'city_id'               => 31848,
            'zip_code'              => $faker->randomNumber(5),
            'po_box'                => $faker->randomNumber(4),
        ]);

        Schema::enableForeignKeyConstraints();

    }
}
