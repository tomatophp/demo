<?php

namespace Modules\EcommerceTheme\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PagesController extends Controller
{
    public function contact(){
        return view('ecommerce-theme::pages.contact');
    }

    public function page($slug){
        return view('ecommerce-theme::pages.page');
    }
}
