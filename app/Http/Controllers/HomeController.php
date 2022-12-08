<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main (){
        return view('home.home');
    }
    public function cgu (){
        return view('home.cgu');
    }
}
