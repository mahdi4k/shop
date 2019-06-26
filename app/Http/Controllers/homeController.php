<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use View;
use App\lib\Mobile_Detect;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected  $view;
    public function __construct()
    {
        
        $detect = new Mobile_Detect();
        if($detect->isMobile() || $detect->isTablet())
        {
            $this->view='mobile.';
        }
        else
        {
            $this->view='';
        }
         
        $cat = Category::where('parent_id', 0)->get();
        View::share('category', $cat);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function single(News $news )
    {
        $post = News::find($news->id);
        $post->increment('viewCount');
        $all_news=News::get()->first();
        $view_name=$this->view.'site.news';
        return view($view_name,compact('all_news'));
     }

}
