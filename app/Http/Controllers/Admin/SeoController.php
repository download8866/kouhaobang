<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    public function index()
    {
        return view('admin.seo.index');
    }

    public function data(Request $request)
    {
        $model = Seo::query();
        $res = $model->orderBy('created_at', 'desc')->paginate($request->get('limit', 30))->toArray();
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res['total'],
            'data' => $res['data']
        ];
        return response()->json($data);
    }

    public function edit($id)
    {
        $config = Seo::find($id);
        return view('admin.seo.edit', compact('config'));
    }

    public function update(Request $request, $id)
    {
        $seo = Seo::findOrFail($id);
        $data = $request->only(['title', 'keyword', 'description']);
        if ($seo->update($data)) {
            return redirect(route('admin.seo'))->with(['status' => '更新成功']);
        }
        return redirect(route('admin.seo'))->withErrors(['status' => '系统错误']);
    }


}
