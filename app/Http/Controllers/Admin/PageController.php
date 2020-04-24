<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public  function  index()
    {
        return view('admin.page.index');
    }

    public  function  data(Request $request){
        $model = Page::query();
        $res = $model->orderBy('created_at','asc')->paginate($request->get('limit',30))->toArray();
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    public  function  edit($id){
        $config = Page::find($id);
        return view('admin.page.edit',compact('config'));
    }

    public  function  update(Request $request,$id){
        $page = Page::findOrFail($id);
        $data = $request->only(['name','content']);
        if ($page->update($data)){
            return redirect(route('admin.page'))->with(['status'=>'更新成功']);
        }
        return redirect(route('admin.page'))->withErrors(['status'=>'系统错误']);
    }
}
