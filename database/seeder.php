<?php

require __DIR__.'/../vendor/autoload.php';
define('DATABASE_PATH', __DIR__.'/../database.sqlite');
require __DIR__.'/../core/database/dbconnection.php';
$countries = require __DIR__.'/../config/countries.php';
$pet_types = require __DIR__.'/../config/pet_types.php';

use Animal\Models\Country;
use Animal\Models\Loss;
use Animal\Models\Pet;
use Animal\Models\PetOwner;
use Animal\Models\PetType;

$faker = Faker\Factory::create();

Country::query()->truncate();
foreach ($countries as $code) {
    Country::create(compact('code'));
}

PetType::query()->truncate();
foreach ($pet_types as $code) {
    PetType::create(compact('code'));
}

PetOwner::query()->truncate();
for ($i = 1; $i <= 10; $i++) {
    PetOwner::create([
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'country_id' => Country::all()->random()->id,
    ]);
}

Pet::query()->truncate();
for ($i = 1; $i <= 10; $i++) {
    Pet::create([
        'name' => $faker->name(),
        'chip' => $faker->randomNumber(6, true),
        'gender' => $faker->boolean(),
        'age' => $faker->randomNumber(1),
        'race' => 'Caniche',
        'tatoo' => 'bouche',
        'description' => $faker->text,
        'photo_path' => $faker->imageUrl($width = 640, $height = 480),
        'pet_type_id' => 1,
    ]);
}
Loss::query()->truncate();
for ($i = 1; $i <= 10; $i++) {
    Loss::create([
        'lost_at' => $faker->dateTime,
        'postal_code' => $faker->postcode,
        'country_id' => Country::all()->random()->id,
        'pet_id' => Pet::all()->random()->id,
        'pet_owner_id' => PetOwner::all()->random()->id,
    ]);
}