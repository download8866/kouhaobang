<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Category;
use App\Models\MyTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewController extends Controller
{
    public function info()
    {
        $template = MyTemplate::where('status', 1)->first();
        return $template ? $template->tag : 'a';
    }

    public function data(Request $request, Article $article)
    {
        $cate = Category::all();
        if ($request->cate) {
            $article = $article->where('category_id', $request->cate);

        }
        $data = Article::with('category')->where('status', '1')->orderBy('id', 'desc')->paginate(10);

        foreach ($data as &$item) {
            if (strlen($item->content) > 200) {
                $item->content = mb_substr($item->content, 0, 200) . '...';
            }
        }
        $top_ranking = Article::where('status', '1')->orderBy('click', 'desc')->select('id', 'title')->paginate(10);
        $menu = 'news';
        return view('home.template.' . $this->info() . '.news', compact('top_ranking', 'data', 'cate', 'menu'));

    }

    public function show($id)
    {
        $menu = 'new_show';
        $data = Article::with('category')->find($id);
        if ($data) {
            $cate = Category::all();
            $data->click += 1;
            $data->save();
            $top_ranking = Article::where('status', '1')->orderBy('click', 'desc')->select('id', 'title')->paginate(10);
            $next = Article::where('id', '>', $id)->first();
            $prev = Article::where('id', '<', $id)->orderBy('id', 'desc')->first();
            return view('home.template.' . $this->info() . '.new_show', compact('top_ranking', 'data', 'cate', 'next', 'prev', 'menu'));
        } else {
            return redirect('/');
        }

    }
}
