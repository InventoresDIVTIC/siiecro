<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
	public function index(){
    	return view('landing.index');
    }

	public function creditos(){
		return view('landing.creditos');
	}
}
