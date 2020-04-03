<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\candidates;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('adminlogin');
});

Route::get('/adminhome', function () {
    return view('Admin.adminhome');
});

Route::get('/add_candidate', function () {
	if (Auth::user()->type == 1) {
        $data = candidates::all();
        return view('Admin.admin_add_candidate', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/add_voter', function () {
    if (Auth::user()->type == 1) {
        $data = User::where('type',0)->get();
        return view('Admin.admin_add_voter', compact('data'));
    } else {
        return redirect()->to('/');
    }
});

Route::get('/deletecandidate/{id}', function ($id) {
    if (Auth::user()->type == 1) {
        candidates::where('id', $id)->delete();
        return back();
    } else {
        return redirect()->to('/');
    }
});

Route::get('/deletevoter/{id}', function ($id) {
    if (Auth::user()->type == 1) {
        User::where('id', $id)->delete();
        return back();
    } else {
        return redirect()->to('/');
    }
});

Route::get('/sendvote/{vlink}', 'adminwork@voteview');

Route::get('/logout', 'adminwork@logout');
Route::get('/winner', 'adminwork@winner');
Route::post('/addcandidate', 'adminwork@addcan');
Route::post('/addvoter', 'adminwork@addvoter');
Route::post('/adminlog', 'adminwork@login');
Route::post('/setvotes', 'adminwork@savevote');