<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    //eager loading
    $jobs = Job::with('employer')->simplePaginate(3);
    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs-test', function () {
    $jobs = Job::all();
//    dd($jobs);
//    dd($jobs[0]);
    dd($jobs[0]->title . ' ' . $jobs[0]->salary);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
