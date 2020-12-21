<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    $scheduled_date = $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 week');
    return [
        'name' => $faker->company(),
        'client_id' => $faker->numberBetween($min = 1, $max = 20),
        'billing' => $faker->numberBetween($min = 10, $max = 100),
        'industry' => $faker->randomElement($array=['メーカー','商社','流通・小売','金融','サービス・インフラ','ソフトウエア・通信','広告・出版・マスコミ','官公庁・公社・団体']),
        'start_date'=>$scheduled_date->format('Y-m-d'),
        'end_date'=> $scheduled_date->modify('+3 week')->format('Y-m-d'),
        "created_at" => now(),
        "updated_at" => now(),
    ];
});
