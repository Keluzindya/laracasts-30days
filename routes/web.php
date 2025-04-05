<?php

use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    //eager loading
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs/index', [
        'jobs' => $jobs
    ]);
});

//create a job
Route::get('/jobs/create', function () {
    return view('jobs.create');
});



Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

Route::post('/jobs', function () {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);


    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});

//Route::get('/jobs-test', function () {
//    $jobs = Job::all();
////    dd($jobs);
////    dd($jobs[0]);
//    dd($jobs[0]->title . ' ' . $jobs[0]->salary);
//});
