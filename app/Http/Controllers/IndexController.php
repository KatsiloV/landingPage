<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;
use App\Work;
use App\Service;
use App\People;


class IndexController extends Controller
{
    //
    public function execute(Request $request) {

    	$pages = Page::all();
    	$works = Work::all();
    	$services = Service::all();
    	$peoples = People::all();

    	$menu  = array();
    	foreach ($pages as $page) {
            $item = array('title' =>$page->name, 'alias'=>$page->alias);
        	array_push($menu,$item);
    	 } 

            
             $item = array('title' =>'About Us', 'alias'=>'about us');
            array_push($menu,$item);

            $item = array('title' =>'Service', 'alias'=>'service');
            array_push($menu,$item);

            
             $item = array('title' =>'Contact', 'alias'=>'contact');
            array_push($menu,$item);

             $item = array('title' =>'Works', 'alias'=>'works');
            array_push($menu,$item);


    	return view('site.index', array(
                                
                                'menu'=> $menu,
                                'pages'=> $pages,
                                'services'=> $services,
                                'works'=> $works,
                                'peoples'=> $peoples,
        ));
    }
}
