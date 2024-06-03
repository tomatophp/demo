<?php

namespace Modules\EcommerceTheme\App\Http\Controllers;

use App\Http\Controllers\Controller;
use TomatoPHP\TomatoCms\Models\Page;
use TomatoPHP\TomatoCms\Models\Portfolio;
use TomatoPHP\TomatoCms\Models\Service;
use TomatoPHP\TomatoCms\Models\Testimonial;

class ServicesController extends Controller
{
    public function show($slug)
    {
        $getService = Service::where('slug', $slug)->where('activated', 1)->first();

        if ($getService) {
            $projects =  Portfolio::where('service_id', $getService->id)->where('activated', 1)->orderBy('id', 'desc')->get()->take(12);
            $reviews = Testimonial::where('service_id', $getService->id)->get();

            if($getService->page){
                return view('ecommerce-theme::index', [
                    "page" => $getService->page,
                    "service" => $getService,
                    "projects" => $projects,
                    "reviews" => $reviews
                ]);
            }
            else {
                return redirect()->back();
            }

        } else {
            return redirect()->back();
        }
    }
}
