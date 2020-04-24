<?php

namespace App\Http\Controllers\Home\Member;

use App\Models\OrderActive;
use App\Traits\Financial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderActiveController extends Controller
{
    use Financial;

    public function index()
    {
        $menu = "active";
        return view('home.member.file.index', compact('menu'));
    }

    public function data(Request $request)
    {
        $model = OrderActive::query();
        //根据资源类型
        if ($request->title) {
            $model = $model->where('title', 'like', "%" . $request->title . "%");
        }
        //根据收支类型
        //开始时间
        if ($request->get('start_time')) {
            $model = $model->where('created_at', '>', "%" . $request->get('start_time'));
        }
        //结束时间
        if ($request->get('end_time')) {
            $model = $model->where('created_at', '<=', "%" . $request->get('end_time'));
        }
        $list = $model->where('mid', auth('member')->user()->id)->paginate($request->get('limit', 30))->toArray();
        $data = [
            'total' => $list['total'],
            'data' => $list['data']
        ];
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $menu = "active_create";
        $act = OrderActive::where('random', $request->act)->first();
        return view('home.member.file.create', compact('act', 'menu'));
    }

    /*素材上传*/
    public function store(Request $request)
    {

        $mid = auth('member')->user()->id;
        if (!$request->act) {
            $result = $this->activeInsert($mid, $request);
            if ($result) {
                return response(['code' => 0, 'info' => '上传成功', 'act' => $result->random]);
            } else {
                return response(['code' => 1, 'info' => '上传失败']);
            }
        } else {
            $act = OrderActive::where('random', $request->act)->first();
            $act->title = $request->title;
            $act->content = $request->content;
            $act->mark = $request->mark;
            $act->reference_url = $request->reference_url;
            $act->upload_name = $request->upload_name;
            $act->path = $request->path;
            $act->save();
            return response(['code' => 0, 'info' => '上传成功', 'act' => $act->random]);
        }

    }


    public function getActive(Request $request)
    {
        $random = $request->act;
        $act = OrderActive::where('random', $random)->first();
        return response()->json($act);
    }


}
