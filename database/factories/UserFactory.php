<?php

use App\User;
use App\User_Profile;
use App\Company_Profile;
use App\Job;
use App\CV;
use App\Category;
use App\Application;
use App\Question;
use App\Answer;
use App\Picture;

use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'admin' => $faker->randomElement([0, 1]),
    	'emp_type' => $faker->randomElement(['employer', 'employee']),
    ];
});

$factory->define(User_Profile::class, function (Faker $faker) {
    return [
        'phone' => $faker->unique()->randomElement([$faker->phoneNumber, NULL]),
        'github' => $faker->unique()->randomElement([$faker->url, NULL]),
        'portfolio' => $faker->unique()->randomElement([$faker->url, NULL]),
        'skills' => $faker->randomElement([$faker->paragraph, NULL]),
    	'summary' => $faker->randomElement([$faker->paragraph(2), NULL]),
    	'job_title' => $faker->randomElement([$faker->word, NULL]),
    	'user_id' => User::where('emp_type', 'employee')->get()->random()->id,
    ];
});

$factory->define(Company_Profile::class, function (Faker $faker) {
    return [
        'website' => $faker->unique()->randomElement([$faker->url, NULL]),
    	'about' => $faker->randomElement([$faker->paragraph, NULL]),
    	'user_id' => User::where('emp_type', 'employer')->get()->random()->id,
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
    ];
});

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->word .' ' . $faker->word .' ' . $faker->word .' ' . $faker->word,
        'subtitle' => $faker->word . ' ' .  $faker->word . ' ' . $faker->word . ' ' . $faker->word .' ' .  $faker->word . ' ' . $faker->word,
        'job_description' => $faker->paragraph,
        'job_type' => $faker->randomElement(['Full Time', 'Part Time', 'Internship']),
        'exp_from' => $faker->randomElement([1,2,3]),
        'exp_to' => $faker->randomElement([4,5,6,7,8,9,10]),
        'requirements' => $faker->paragraph,
        'responsibility' => $faker->paragraph,
        'skills' => $faker->paragraph,
        'salary' => $faker->randomElement(['3000', '2500', '5000', 'Confidential']),
        'category_id' => Category::all()->random()->id,
        'active' => $faker->randomElement([0, 1]),
        'user_id' => User::where('emp_type', 'employer')->get()->random()->id,
    ];
});

$factory->define(Picture::class, function (Faker $faker) {
    return [
        'filename' => $faker->randomElement(['1.jpg', '2.jpg', 'user.jpg']),
        'filesize' => $faker->randomElement([1,2]),
        'user_id' => User::all()->random()->id,
    ];
});

$factory->define(CV::class, function (Faker $faker) {
    return [
        'filename' => $faker->word,
        'size_m' => $faker->randomElement([1,2]),
        'user_id' => User::where('emp_type', 'employee')->get()->random()->id,
    ];
});

$factory->define(Application::class, function (Faker $faker) {
    return [
        'seen' => $faker->randomElement([0, 1]),
        'contact' => $faker->randomElement([0, 1]),
        'accepted' => $faker->randomElement([0, 1, -1]),
        'user_id' => User::where('emp_type', 'employee')->get()->random()->id,
        'job_id' => Job::all()->random()->id,
    ];
});


$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'application_id' => Application::all()->random()->id,
    ];
});

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'the_answer' => $faker->word,
        'question_id' => Question::all()->random()->id,
        'user_id' => User::where('emp_type', 'employee')->get()->random()->id,
    ];
});
