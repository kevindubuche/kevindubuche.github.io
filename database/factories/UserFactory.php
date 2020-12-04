<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Hospital;
use App\Models\Patient;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        // 'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Hospital::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'adresse' => $faker->name,
        'code_hospital' => $faker->name,
        'maximum_visites_par_jour' => $faker->randomDigitNotNull,
        'commune' => $faker->name,
        'departement' => $faker->name,
      
    ];
});


$factory->define(Patient::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'prenom' => $faker->name,
        'sexe' => $faker->name,
        'date_naissance' => $faker->date('Y-m-d H:i:s'),
        'commune' => 'Carrefour',
        'departement' => $faker->word,
        'telephone' => $faker->phoneNumber,
        'rue' => $faker->name,
        'raison_test' => 'Cas suspect',       
      
    ];
});