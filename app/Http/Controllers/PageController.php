<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function aboutPage()
    {
        $service =array(
            'title'=>'Welcome to Home Page',
            'services'=>['Web Development','App Development','Local Software']
        );

        return view('pages.service')->with($service);
    }

}
