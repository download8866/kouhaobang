<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Message;
use App\Models\User;
use App\Traits\PushMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    use PushMessage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.message.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $model = Message::query();
        //
        if ($request->get('title')) {
            $model = $model->where('title', 'like', "%" . $request->get('title') . "%");
        }
        //开始时间
        if ($request->get('start_time')) {
            $model = $model->where('created_at', '>', $request->get('start_time'));
        }
        //结束时间
        if ($request->get('end_time')) {
            $model = $model->where('created_at', '<=', $request->get('end_time'));
        }
        $model = $model->orderBy('id', 'desc')->paginate($request->get('limit', 30))->toArray();
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $model['total'],
            'data' => $model['data']
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
        return view('admin.message.create');
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
            'flag' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);
        $info = Message::where('created_at')->first();

        $data = $request->only(['flag', 'title', 'content']);
        Message::create($data);
        return response(['code' => 0, 'info' => '消息推送完成']);
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
        $info = Message::find($id);
        return view('admin.message.edit', compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'flag' => 'required',
            'title' => 'required',
            'content' => 'required|min:4|max:400'
        ]);
        $data = $request->only(['flag', 'title', 'content']);
        Message::where('id', $request->id)->update($data);
        return response(['code' => 0, 'info' => '消息推送完成']);

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
        if (Message::destroy($ids)) {
            return response()->json(['code' => 0, 'msg' => '删除成功']);
        }
        return response()->json(['code' => 1, 'msg' => '删除失败']);
    }


}
