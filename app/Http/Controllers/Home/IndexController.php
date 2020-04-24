<?php

namespace App\Http\Controllers\Home;

use App\Models\Advert;
use App\Models\Article;
use App\Models\MyTemplate;
use App\Models\OrderActive;
use App\Models\Page;
use App\Models\SarticleOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function info()
    {
        $template = MyTemplate::where('status', 1)->first();
        return $template ? $template->tag : 'a';
    }

    public function index()
    {
        $menu = "index";
        $image = Advert::where('id', '1')->first();
        $image->thumb = explode(',', $image->thumb);
        $tag = $this->info();
        $news = Article::where('status', 1)->orderBy('id', 'desc')->limit(3)->get();
        return view('home.template.' . $tag . '.index', compact('menu', 'image', 'news'));
    }


    public function activeView(Request $request)
    {
        $id = $request->id;
        $active = OrderActive::where('random', $id)->first();
        $order = SarticleOrder::with('sarticle')->where('active_id', $active->id)->first();
        $content = $active->content;
        $mark = $active->mark;
        $name = $active->title;
        if ($order) {
            $title = $order->sarticle->title;
        } else {
            $title = '';
        }
        return view('home.common.active_view', compact('content', 'title', 'mark', 'name'));
    }

    public function aboutUs()
    {
        $menu = "about";
        $company = Page::where('tag', 'company')->first();
        $contact = Page::where('tag', 'contact')->first();
        $tag = $this->info();
        return view('home.template.' . $tag . '.about', compact('company', 'contact', 'menu'));
    }
}
