<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinkController extends Controller
{
    public function index()
    {
        return view('admin.link.index');
    }

    public function data(Request $request)
    {
        $model = Link::query();
        $res = $model->orderBy('created_at', 'asc')->paginate($request->get('limit', 30))->toArray();
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res['total'],
            'data' => $res['data']
        ];
        return response()->json($data);
    }

    public function create()
    {
        return view('admin.link.create');
    }


    public function store(Request $request)
    {

        $data = $request->only(['name', 'status', 'url']);
        $data['status'] = $request->status == 'on' ? 1 : 0;
        Link::create($data);
        return redirect(route('admin.link'))->with(['status' => '添加成功']);
    }

    public function edit($id)
    {
        $config = Link::find($id);
        return view('admin.link.edit', compact('config'));
    }

    public function update(Request $request, $id)
    {
        $page = Link::findOrFail($id);
        $data = $request->only(['name', 'url', 'status']);
        $data['status'] = $request->status == 'on' ? 1 : 0;
        if ($page->update($data)) {
            return redirect(route('admin.link'))->with(['status' => '更新成功']);
        }
        return redirect(route('admin.link'))->withErrors(['status' => '系统错误']);
    }


    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)) {
            return response()->json(['code' => 1, 'msg' => '请选择删除项']);
        }
        foreach (Link::whereIn('id', $ids)->get() as $model) {
            //删除文章
            $model->delete();
        }
        return response()->json(['code' => 0, 'msg' => '删除成功']);
    }
}
