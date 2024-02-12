<?php

namespace Themes\Ecommerce\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PagesController extends Controller
{
    public function contact(){
        return view('themes::pages.contact');
    }

    public function page($slug){
        return view('themes::pages.page');
    }
}
