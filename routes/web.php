<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

// routes de l accueil
Route::get('/', 'HomeController@main')->name('home');
Route::get('/conditions', 'HomeController@cgu')->name('cgu');

// routes de la map
Route::get('/map', 'MapController@index')->name('map');
Route::post('/map', 'MapController@index');


# Socialite URLs
// La redirection vers le provider
Route::get("redirect/{provider}", "SocialiteController@redirect")->name('socialite.redirect');

// Le callback du provider
Route::get("callback/{provider}", "SocialiteController@callback")->name('socialite.callback');

# Les routes backOffice
Route::group(['middleware' => 'auth'], function (){
    Route::get('admin', 'AdminController@index');
    Route::get('profile', 'UsersController@show')->name('profile');
    Route::get('profile/{user_id}/edit', 'UsersController@edit');

// Partie gestion admin
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController')->middleware('can:isAdmin');
    Route::resource('categories', 'CategoriesController')->middleware('can:isAdmin');
    Route::resource('souscategories', 'SousCategoriesController')->middleware('can:isAdmin');
    Route::resource('commerces', 'CommercesController')->middleware('role:admin,responsable-commerce,moderateur');
    Route::resource('unites', 'UnitesController')->middleware('can:isAdmin');
    Route::resource('produits', 'ProduitsController')->middleware('role:admin,responsable-commerce');
    Route::resource('commentaires', 'CommentairesController');
});
