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
use Animal\Models\User;

$faker = Faker\Factory::create();

$countries_csv = __DIR__.'/countries.csv';
//Ouvrir le fichier
$file_handle = fopen($countries_csv, 'rb');
// Récupérer les entêtes du CSV
$headers = fgetcsv($file_handle, 1000, escape: '');
// Mettre en lien les langues supportées par l'app avec les entêtes qui leur correspondent
$available_languages = ['EN' => 'name.common', 'FR' => 'translations.fra.common', 'IT' => 'translations.ita.common', 'PT' => 'translations.por.common'];
// Récupérer l'indice de la colonne qui contient le code cca2
$cca2_index = array_find_key($headers, fn($item) => $item === 'cca2');
// Récupérer les indices des colonnes qui contiennent les traductions utiles dans notre app
$header_indexes = [];
foreach ($available_languages as $cca2 => $translation_header) {
    $header_indexes[$cca2] = array_find_key($headers, fn($item) => $item === $translation_header);
}


// Préparer les chaînes à écrire dans les fichiers php. On commence par le code qui définit un array
foreach (array_keys($available_languages) as $lang_code) {
    $$lang_code = '<?php return ['.PHP_EOL;
}
// Pour la db, on aura d'un besoin d'un array des cca2 qui sont dans le csv
$cca2s = [];
// On commence à parcourir le csv, une ligne à la fois
while ($country_row = fgetcsv($file_handle, 1000, escape: '')) {
    //Certains caractères peuvent casser l'analyse apparemment. Ce test est une petite précaution 🤞🍀
    if (count($country_row) === count($headers)) {
        // Pour chaque langue, on peut alors compléter l'array pour le pays en cours.
        foreach (array_keys($available_languages) as $lang_code) {
            $cca2 = $country_row[$cca2_index];
            $$lang_code .= '"'.$cca2.'" => "'.$country_row[$header_indexes[$lang_code]].'",'.PHP_EOL;
        }
        // Et on n'oublie pas d'ajouter le cca2 du pays en cours dans l'array des cca2 dont on aura besoin dans la db
        $cca2s[] = $country_row[$cca2_index];
    }
}
// On finalise le code php qu'on doit écrire dans les fichiers, et on l'écrit.
foreach (array_keys($available_languages) as $lang_code) {
    $$lang_code .= '];'.PHP_EOL;
    file_put_contents(__DIR__.'/../lang/'.strtolower($lang_code).'/countries.php', $$lang_code);
}


Country::query()->truncate();
foreach ($cca2s as $code) {
    Country::create(compact('code'));
}

/*Country::query()->truncate();
foreach ($countries as $code) {
    Country::create(compact('code'));
}*/

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
        'name' => $faker->firstName(),
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

User::query()->truncate();
User::create([
    'email' => 'brunome638@gmail.com',
    'password'=>password_hash('password', PASSWORD_BCRYPT),
]);