<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MemberCreateRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Models\Member;
use App\Models\MemberFinance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member.index');
    }

    public function data(Request $request)
    {
        $model = Member::query();
        if ($request->get('name')) {
            $model = $model->where('name', 'like', '%' . $request->get('name') . '%');
        }
        if ($request->get('phone')) {
            $model = $model->where('phone', 'like', '%' . $request->get('phone') . '%');
        }
        if ($request->get('qq')) {
            $model = $model->where('qq', 'like', '%' . $request->get('qq') . '%');
        }
        $res = $model->orderBy('created_at', 'desc')->paginate($request->get('limit', 30))->toArray();
        foreach ($res['data'] as &$item) {
//            $item['city'] = $this->getCity($item['register_ip'])['city'];
            $record = MemberFinance::where('mid', $item['id'])->orderBy('id', 'desc')->first();
            $item['number'] = MemberFinance::where('mid', $item['id'])->where('type', 1)->count();
            $item['money'] = $record ? $record->total_money : 0;
        }
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res['total'],
            'data' => $res['data']
        ];
        return response()->json($data);
    }

    //获取城市ip
    function getCity($ip = '')
    {
        if ($ip == '') {
            $url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
            $ip = json_decode(file_get_contents($url), true);
            $data = $ip;
        } else {
            $url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip;
            $ip = json_decode(file_get_contents($url));
            if ((string)$ip->code == '1') {
                return false;
            }
            $data = (array)$ip->data;
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberCreateRequest $request)
    {
        $data = $request->except('password_confirmation', 'file', '_token');
        $user = Member::where('name', $data['name'])->orWhere('phone', $data['phone'])->first();
        if ($user) {
            return redirect()->to(route('admin.member'))->withErrors('手机号或登录名已存在');
        }
        $data['password'] = bcrypt($data['password']);
        $data['uuid'] = \Faker\Provider\Uuid::uuid();
        $data['last_login_ip'] = '127.0.0.1';
        $data['register_ip'] = '127.0.0.1';
        if (Member::create($data)) {
            return redirect()->to(route('admin.member'))->with(['status' => '添加账号成功']);
        }
        return redirect()->to(route('admin.member'))->withErrors('系统错误');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberUpdateRequest $request, $id)
    {
        $member = Member::findOrFail($id);
        $data = $request->except('password_confirmation', 'file', '_token', '_method');
        if (!$data['password']) {
            unset($data['password']);
        }
        if ($request->get('password')) {
            $data['password'] = bcrypt($request->get('password'));
        }
        if ($member->update($data)) {
            return redirect()->to(route('admin.member'))->with(['status' => '更新用户成功']);
        }
        return redirect()->to(route('admin.member'))->withErrors('系统错误');
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
        if (Member::destroy($ids)) {
            return response()->json(['code' => 0, 'msg' => '删除成功']);
        }
        return response()->json(['code' => 1, 'msg' => '删除失败']);
    }

    /*启用/禁用*/
    public function status(Request $request)
    {
        $ids = $request->input('ids');
        $status = (int)$request->input('status');
        foreach ($ids as $id) {

            Member::where('id', $id)->update(['status' => $status]);
        }
        return response()->json(['code' => 0, 'info' => '处理成功']);
    }
}
