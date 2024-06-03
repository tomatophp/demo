<?php

namespace Modules\EcommerceTheme\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TomatoPHP\TomatoCms\Models\Page;
use TomatoPHP\TomatoCms\Models\Portfolio;
use TomatoPHP\TomatoCms\Models\Service;
use TomatoPHP\TomatoCms\Models\Testimonial;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::where('slug', '/projects')->first();

        $projects = Portfolio::query();
        $projects->with('service');

        if ($request->has('service')) {
            $getService = Service::where('slug', $request->get('service'))->first();
            if ($getService) {
                $projects->where('service_id', $getService->id);
            }
        }
        if($request->has('search')){
            $projects->where('title', 'like', '%'.$request->get('search').'%' );
        }
        if($request->has('filter')){
            if($request->get('filter') === 'popular'){
                $projects->orderBy('views', 'desc');
            }
            if($request->get('filter') === 'recent'){
                $projects->orderBy('id', 'desc');
            }
            if($request->get('filter') === 'alphabetical'){
                $projects->orderBy('title');
            }

        }
        else {
            $projects->inRandomOrder();
        }

        $projects = $projects->paginate(9);

        return view('ecommerce-theme::index', [
            "projects" =>  $projects,
            'page' => $page
        ]);
    }

    public function show(Portfolio $project)
    {
        $page = Page::where('slug', 'projects-single')->first();

        if ($project) {
            $project->views += 1;
            $project->save();
            $rel = Portfolio::where('service_id', $project->service_id)->where('id', '!=', $project->id)->orderBy('id', 'desc')->get()->take(3);
            return view('ecommerce-theme::project.index', [
                "project" =>  $project,
                "rel" => $rel,
                "page" => $page
            ]);
        } else {
            return redirect()->to('/');
        }
    }
}
