<?php

namespace App\Http\Controllers\Admin;

use App\Models\Secret;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        return view('admin.ticket.index');
    }


    public function data(Request $request)
    {
        $get = '/api/v4/work/order/list';
        $data = [];
        $result = $this->pushTicket($get, $data);
        $result = json_decode(json_decode($result));
        if ($result->code == 200) {

            $data_s = $result->data;
            $data = [
                'code' => 0,
                'msg' => '正在请求中...',
                'count' => $data_s->total,
                'data' => $data_s->data
            ];
        } else {
            $data = [
                'code' => 4001,
                'msg' => $result->info,
                'count' => 0,
                'data' => []
            ];
        }
        return response()->json($data);

    }


    public function create()
    {
        return view('admin.ticket.create');
    }


    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data_s = $data;
        $get = 'api/v4/work/order/send';
        $this->pushTicket($get, $data_s);
        return response(['code' => 1, 'info' => '提交成功']);
    }

    public function pushTicket($u, $data)
    {
        $url = config('yun.ticket') . $u;
        $secret = Secret::find(1);
        $data['appKey'] = $secret->key;
        $data['appSecret'] = $secret->secret;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);//此处以当前服务器为接收地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);//设置最长等待时间
        curl_setopt($ch, CURLOPT_POST, 1);//post提交
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $data = curl_exec($ch);//执行
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);//释放
        return json_encode($data);

    }


}
