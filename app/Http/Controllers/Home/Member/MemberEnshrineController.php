<?php

namespace App\Http\Controllers\Home\Member;

use App\Models\MemberEnshrine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberEnshrineController extends Controller
{
    public function store(Request $request)
    {
        $type = $request->type;
        $status = $request->status;
        $id = $request->id;
        $info = MemberEnshrine::where(['product_id' => $id, 'type' => $type])->first();
        if ($status == 1 && !$info)//收藏
        {
            MemberEnshrine::create([
                'type' => $type,
                'mid' => auth('member')->user()->id,
                'product_id' => $id,
            ]);

        } else {//取消收藏
            MemberEnshrine::where(['product_id' => $id, 'type' => $type])->delete();
        }
        return response(['code' => 0, 'info' => $status == 1 ? '收藏成功' : '取消成功']);
    }
}
