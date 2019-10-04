<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Page;
use App\Work;
use App\Service;
use App\People;
use Mail;


class IndexController extends Controller
{
    //
    public function execute(Request $request) {


        if($request->isMethod('post')) {

            $messages = [
              'required' => "Поле :attribute обязательно к заполнению",
              'email' => "Поле :attribute должно соответствовать email-адресу"
            ];

            $this->validate($request, [
             
             'name' => 'required|max:255',
             'email' => 'required|email',
             'text' => 'required'           
         ], $messages);
         
         $data = $request->all();

         $result = Mail::send('site.email', ['data'=>$data], function($message) {

             $mail_admin = env('MAIL_ADMIN');
             $message->from($data['email'], $data['name']);
             $message->to($mail_admin, 'Mr. Admin')->subject('Question');

         });
    
        if($result) {
            return redirect()->route('home')->with('status', 'Email is send');
        }

         }

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
