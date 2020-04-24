<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 20:19:50
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Home\Member;

use App\Models\Advert;
use App\Models\Member;
use App\Models\MemberFinance;
use App\Models\Message;
use App\Models\MyApply;
use App\Models\Sarticle;
use App\Models\SarticleOrder;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        $menu = "member";
        $image = Advert::where('id', '4')->first();
        $mid = auth('member')->user()['id'];
        $image->thumb = explode(',', $image->thumb);
        $info = Member::where('id', $mid)->first(['phone', 'name', 'username', 'mobile', 'qq', 'company', 'email', 'industry']);
        $message = Message::OrderBy('id', 'desc')->limit(4)->get();
        $charge = MemberFinance::where('mid', $mid)->whereIn('type', [2, 4])->sum('money');
        $pay = MemberFinance::where('mid', $mid)->where('type', 1)->sum('money');
        $back = MemberFinance::where('mid', $mid)->whereIn('type', [3, 5])->sum('money');
        $Ur0 = $pay - $back;
        $pay = $Ur0;
        $money = MemberFinance::where('mid', $mid)->orderBy('id', 'desc')->first(['id', 'total_money']);
        if (MyApply::where(['tag' => 'sarticle', 'status' => 1])->first()) goto UrBodyx2;
        goto UrNextx2;
        UrBodyx2:
        $order_sure = SarticleOrder::where('mid', $mid)->whereIn('status', [6, 7])->count();
        $order_for = SarticleOrder::where('mid', $mid)->where('status', 5)->count();
        $order_accept = SarticleOrder::where('mid', $mid)->where('status', 2)->count();
        $sarticle = Sarticle::where('recommend', 'like', '%2%')->where('status', 1)->limit(4)->get(['id', 'title', 'logo', 'price']);
        $A__AA = "count";
        $UrAC0 = $A__AA($sarticle);
        $Ur0 = $UrAC0 == 0;
        if ($Ur0) goto UrBodyx4;
        goto UrNextx4;
        UrBodyx4:
        $sarticle = Sarticle::where('status', 1)->limit(4)->orderByRaw("RAND()")->get(['id', 'title', 'logo', 'price']);
        goto Urx3;
        UrNextx4:Urx3:
        goto Urx1;
        UrNextx2:
        $order_sure = 0;
        $order_for = 0;
        $order_accept = 0;
        $UrAC0 = array();
        $sarticle = $UrAC0;
        Urx1:
        return view('home.member.member', compact('menu', 'image', 'info', 'message', 'charge', 'pay', 'order_accept', 'order_for', 'order_sure', 'money', 'sarticle'));
    }

    public function setPayPass(Request $request)
    {
        $validate = Validator::make($request->all(), ['password' => 'required|min:6|max:6|confirmed', 'password_confirmation' => 'required']);
        $UrAC1 = array();
        $UrAC2 = array();
        $UrAC2[] = $validate;
        $UrAC2[] = "fails";
        $UrAC0 = call_user_func_array($UrAC2, $UrAC1);
        $Ur0 = !$UrAC0;
        if ($Ur0) goto UrBodyx6;
        goto UrNextx6;
        UrBodyx6:
        $member = Member::where(['id' => auth('member')->user()['id']])->first();
        $member->pay_pass = md5($request->password);
        $UrAC1 = array();
        $UrAC2 = array();
        $UrAC2[] = $member;
        $UrAC2[] = "save";
        $UrAC0 = call_user_func_array($UrAC2, $UrAC1);
        $UrAC1 = array();
        $UrAC1[] = 'info';
        $UrAC1[] = '密码设置成功';
        $UrAC2 = array();
        $UrAC2[] = $this;
        $UrAC2[] = "set";
        $UrAC0 = call_user_func_array($UrAC2, $UrAC1);
        return response(['code' => 0, 'info' => '密码设置成功']);
        goto Urx5;
        UrNextx6:
        $UrAC1 = array();
        $UrAC2 = array();
        $UrAC2[] = $validate;
        $UrAC2[] = "errors";
        $UrAC0 = call_user_func_array($UrAC2, $UrAC1);
        $UrAC4 = array();
        $UrAC4[] = 'password';
        $UrAC5 = array();
        $UrAC5[] = $UrAC0;
        $UrAC5[] = "has";
        $UrAC3 = call_user_func_array($UrAC5, $UrAC4);
        if ($UrAC3) goto UrBodyx8;
        goto UrNextx8;
        UrBodyx8:
        return response(['code' => 1, 'info' => '请填写6位数字密码']);
        goto Urx7;
        UrNextx8:
        return response(['code' => 1, 'info' => '参数错误']);
        Urx7:Urx5:
    }

    public function message()
    {
        $menu = "message";
        return view('home.member.message', compact('menu'));
    }

    public function messageData(Request $request)
    {
        $model = Message::query();
        $list = $model->paginate($request->get('limit', 30))->toArray();
        $UrAC0 = array();
        $UrAC0['total'] = $list['total'];
        $UrAC0['data'] = $list['data'];
        $data = $UrAC0;
        return response()->json($data);
    }

    public function basicInfo()
    {
        $menu = "basic";
        $mid = auth('member')->user()->id;
        $info = Member::where('id', $mid)->first(['name', 'company', 'username', 'industry', 'qq', 'email', 'mobile']);
        return view('home.member.basic', compact('menu', 'info'));
    }

    public function basicUpdate(Request $request)
    {
        $UrAC1 = array();
        $UrAC2 = array();
        $UrAC2[] = $request;
        $UrAC2[] = "all";
        $UrAC0 = call_user_func_array($UrAC2, $UrAC1);
        $data_s = $UrAC0;
        $UrAC0 = array();
        $data = $UrAC0;
        $Ur0 = (bool)isset($data_s['company']);
        if ($Ur0) goto UrBodyxb;
        goto UrNextxb;
        UrBodyxb:
        $Ur0 = (bool)$data_s['company'];
        goto Urxa;
        UrNextxb:Urxa:
        if ($Ur0) goto UrBodyxc;
        goto UrNextxc;
        UrBodyxc:
        $data['company'] = $data_s['company'];
        goto Urx9;
        UrNextxc:Urx9:
        $Ur0 = (bool)isset($data_s['username']);
        if ($Ur0) goto UrBodyxf;
        goto UrNextxf;
        UrBodyxf:
        $Ur0 = (bool)$data_s['username'];
        goto Urxe;
        UrNextxf:Urxe:
        if ($Ur0) goto UrBodyxg;
        goto UrNextxg;
        UrBodyxg:
        $data['username'] = $data_s['username'];
        goto Urxd;
        UrNextxg:Urxd:
        $Ur0 = (bool)isset($data_s['industry']);
        if ($Ur0) goto UrBodyxj;
        goto UrNextxj;
        UrBodyxj:
        $Ur0 = (bool)$data_s['industry'];
        goto Urxi;
        UrNextxj:Urxi:
        if ($Ur0) goto UrBodyxk;
        goto UrNextxk;
        UrBodyxk:
        $data['industry'] = $data_s['industry'];
        goto Urxh;
        UrNextxk:Urxh:
        $Ur0 = (bool)isset($data_s['qq']);
        if ($Ur0) goto UrBodyxn;
        goto UrNextxn;
        UrBodyxn:
        $Ur0 = (bool)$data_s['qq'];
        goto Urxm;
        UrNextxn:Urxm:
        if ($Ur0) goto UrBodyxo;
        goto UrNextxo;
        UrBodyxo:
        $data['qq'] = $data_s['qq'];
        goto Urxl;
        UrNextxo:Urxl:
        $Ur0 = (bool)isset($data_s['email']);
        if ($Ur0) goto UrBodyxr;
        goto UrNextxr;
        UrBodyxr:
        $Ur0 = (bool)$data_s['email'];
        goto Urxq;
        UrNextxr:Urxq:
        if ($Ur0) goto UrBodyxs;
        goto UrNextxs;
        UrBodyxs:
        $data['email'] = $data_s['email'];
        goto Urxp;
        UrNextxs:Urxp:
        $Ur0 = (bool)isset($data_s['name']);
        if ($Ur0) goto UrBodyxv;
        goto UrNextxv;
        UrBodyxv:
        $Ur0 = (bool)$data_s['name'];
        goto Urxu;
        UrNextxv:Urxu:
        if ($Ur0) goto UrBodyxw;
        goto UrNextxw;
        UrBodyxw:
        $data['name'] = $data_s['name'];
        goto Urxt;
        UrNextxw:Urxt:
        $Ur0 = (bool)isset($data_s['mobile']);
        if ($Ur0) goto UrBodyxz;
        goto UrNextxz;
        UrBodyxz:
        $Ur0 = (bool)$data_s['mobile'];
        goto Urxy;
        UrNextxz:Urxy:
        if ($Ur0) goto UrBodyx11;
        goto UrNextx11;
        UrBodyx11:
        $data['mobile'] = $data_s['mobile'];
        goto Urxx;
        UrNextx11:Urxx:
        $Ur0 = (bool)isset($data_s['password']);
        if ($Ur0) goto UrBodyx14;
        goto UrNextx14;
        UrBodyx14:
        $Ur0 = (bool)$data_s['password'];
        goto Urx13;
        UrNextx14:Urx13:
        if ($Ur0) goto UrBodyx15;
        goto UrNextx15;
        UrBodyx15:
        $data['password'] = password_hash($data_s['password'], PASSWORD_DEFAULT);
        goto Urx12;
        UrNextx15:Urx12:
        $A_A__ = "count";
        $UrAC0 = $A_A__($data);
        if ($UrAC0) goto UrBodyx17;
        goto UrNextx17;
        UrBodyx17:
        $mid = auth('member')->user()->id;
        $result = Member::where('id', $mid)->update($data);
        if ($result) goto UrBodyx19;
        goto UrNextx19;
        UrBodyx19:
        return response(['code' => 0, 'info' => '编辑成功']);
        goto Urx18;
        UrNextx19:
        return response(['code' => 1, 'info' => '编辑失败']);
        Urx18:
        goto Urx16;
        UrNextx17:
        return response(['code' => 1, 'info' => '参数错误']);
        Urx16:
    }

    public function getUserInfo()
    {
        $info['id'] = auth('member')->user()->id;
        $Ur0 = auth('member')->user()->name ?? substr_replace(auth('member')->user()->phone, '****', 3, 4);
        $info['name'] = $Ur0;
        $money = MemberFinance::where('mid', auth('member')->user()->id)->orderBy('id', 'desc')->first(['id', 'total_money']);
        if ($money) goto UrBodyx1b;
        goto UrNextx1b;
        UrBodyx1b:
        $Ur0 = $money->total_money;
        goto Urx1a;
        UrNextx1b:
        $Ur0 = 0;
        Urx1a:
        $info['money'] = $Ur0;
        return response(['code' => 0, 'data' => $info]);
    }
}

?>