<?php

use Illuminate\Support\Facades\Auth;

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
  return view('welcome');
});

Route::get('discover', function() {
  $loans = App\Loan::with('User')->get();
  foreach($loans as $loan) {
    $loan['user_like'] = count(App\Like::where(['loan_id' => $loan->id, 'user_id' => Auth::id()])->get());
  }
  $data['loans'] = $loans;
  // return $loans;
  // return view('pages.backup.discover', $data);
  return view('pages.discover', $data);
});

Route::get('about', function() {
  return view('pages.about');
});

Route::get('contact', function() {
  return view('pages.contact');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::resource('loans', 'LoansController');
