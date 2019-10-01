<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
     public function execute(Request $request) {

    	$pages = Page::all();
    	$works = Work::all();
    	$services = Service::all();
    	$peoples = People::all();

    }
}
