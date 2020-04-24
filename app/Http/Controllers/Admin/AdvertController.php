<?php

namespace App\Http\Controllers\Admin;

use App\Models\Advert;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::get();
        return view('admin.advert.index', compact('positions'));
    }

    public function data(Request $request)
    {
        $model = Advert::query();
        if ($request->get('position_id')) {
            $model = $model->where('position_id', $request->get('position_id'));
        }
        if ($request->get('title')) {
            $model = $model->where('title', 'like', '%' . $request->get('title') . '%');
        }
        $res = $model->orderBy('sort', 'desc')->orderBy('id', 'desc')->with('position')->paginate($request->get('limit', 30))->toArray();

        foreach ($res['data'] as &$item) {
            $item['thumb'] = explode(',', $item['thumb'])[0];

        }

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res['total'],
            'data' => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //所有广告位置
        $positions = Position::orderBy('sort', 'desc')->get();
        return view('admin.advert.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            //'title'  => 'required|string',
            'sort' => 'required|numeric',
            'thumb' => 'required|string',
            'position_id' => 'required|numeric'
        ]);
        if (Advert::create($request->all())) {
            return redirect(route('admin.advert'))->with(['status' => '添加完成']);
        }
        return redirect(route('admin.advert'))->with(['status' => '系统错误']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Advert::with('position')->findOrFail($id);
        $data->thumbs = explode(',', $data->thumb);
        return view('admin.advert.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'url' => 'required',
        ]);
        if (!$validate->fails()) {
            $images = implode(',', $request->url);
            if (Advert::where('id', $id)->update(['thumb' => $images])) {
                return redirect(route('admin.advert'))->with(['status' => '更新成功']);
            } else {
                return redirect(route('admin.advert'))->with(['status' => '更新失败']);
            }
        } else {
            return back()->withErrors(['status' => '请添加图片再提交']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (empty($ids)) {
            return response()->json(['code' => 1, 'msg' => '请选择删除项']);
        }
        if (Advert::destroy($ids)) {
            return response()->json(['code' => 0, 'msg' => '删除成功']);
        }
        return response()->json(['code' => 1, 'msg' => '删除失败']);
    }
}
