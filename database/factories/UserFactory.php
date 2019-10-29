<?php

use App\User;
use App\UserProfile;
use App\CompanyProfile;
use App\Job;
use App\Resume;
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

$factory->define(UserProfile::class, function (Faker $faker) {
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

$factory->define(CompanyProfile::class, function (Faker $faker) {
    return [
        'website' => $faker->unique()->randomElement([$faker->url, NULL]),
    	'address' => $faker->word.' '.$faker->word,
        'about' => $faker->paragraph,
    	'user_id' => User::where('emp_type', 'employer')->get()->random()->id,
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
    ];
});

$factory->define(Job::class, function (Faker $faker) {

    $title = $faker->word .' ' . $faker->word .' ' . $faker->word .' ' . $faker->word;
    $slug = str_replace(' ', '-', $title);

    return [
        'title' => $title,
        'subtitle' => $faker->word . ' ' .  $faker->word . ' ' . $faker->word . ' ' . $faker->word .' ' .  $faker->word . ' ' . $faker->word,
        'slug' => $slug,
        'job_description' => $faker->paragraph,
        'job_type' => $faker->randomElement(['Full Time', 'Part Time', 'Internship']),
        'exp_from' => $faker->randomElement([1,2,3]),
        'exp_to' => $faker->randomElement([4,5,6,7,8,9,10]),
        'requirements' => $faker->paragraph,
        'responsibility' => $faker->paragraph,
        'skills' => $faker->paragraph,
        'work_place' => $faker->randomElement(['damanhour', 'cairo', 'alex', 'alexandria', 'freelance', 'giza']),
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

$factory->define(Resume::class, function (Faker $faker) {
    return [
        'filename' => $faker->word,
        'filesize' => $faker->randomElement([1,2,3,4,5,6,7,8,9]) * 100,
        'user_id' => User::where('emp_type', 'employee')->get()->random()->id,
    ];
});

$factory->define(Application::class, function (Faker $faker) {
    $job_ids = [];
    for($i=1;$i<=50;$i++){
        $job_ids[] = $i;
    }
    return [
        'job_id' => $faker->unique()->randomElement($job_ids),
    ];
});


$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => $faker->word . ' ' . $faker->word . ' ' . $faker->word . ' ' . $faker->word . ' ' . $faker->word . ' ' . $faker->word . ' ' . $faker->word . ' ' . $faker->word . ' ' . $faker->word . ' ?',
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
