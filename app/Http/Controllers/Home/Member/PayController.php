<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:42:50
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Home\Member;

use App\Models\Member;
use App\Models\MemberCharge;
use App\Models\MemberFinance;
use App\Models\PaySetting;
use App\Traits\Financial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yansongda\LaravelPay\Facades\Pay;

class PayController extends Controller
{
    use Financial;

    public function index()
    {
        $menu = "pay";
        $Jo0 = auth('member')->user()->phone ?? auth('member')->user()->name;
        $account = $Jo0;
        $money = MemberFinance::where('mid', auth('member')->user()->id)->orderBy('id', 'desc')->first();
        if ($money) goto JoBodyx2;
        goto JoNextx2;
        JoBodyx2:
        $Jo0 = $money->total_money;
        goto Jox1;
        JoNextx2:
        $Jo0 = 0;
        Jox1:
        $total = $Jo0;
        $pay_setting = PaySetting::where('status', 1)->first();
        return view('home.member.finance.pay', compact('account', 'total', 'menu', 'pay_setting'));
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), ['money' => 'required|numeric',]);
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "all";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $data = $JoAC0;
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $validate;
        $JoAC2[] = "fails";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $Jo0 = !$JoAC0;
        if ($Jo0) goto JoBodyx4;
        goto JoNextx4;
        JoBodyx4:
        $mid = auth('member')->user()->id;
        unset($JoACV1);
        $AAA__AA = "is_array";
        $JoAC6 = $AAA__AA($data);
        if ($JoAC6) goto JoBodyx8;
        goto JoNextx8;
        JoBodyx8:
        $JoACV1 =& $data['money'];
        goto Jox7;
        JoNextx8:
        $JoACV1 = $data['money'];
        Jox7:
        unset($JoACV2);
        $AAA__A_ = "is_array";
        $JoAC5 = $AAA__A_($data);
        if ($JoAC5) goto JoBodyx6;
        goto JoNextx6;
        JoBodyx6:
        $JoACV2 =& $data['pay_type'];
        goto Jox5;
        JoNextx6:
        $JoACV2 = $data['pay_type'];
        Jox5:
        $JoAC3 = array();
        $JoAC3[] =& $mid;
        $JoAC3[] =& $JoACV1;
        $JoAC3[] =& $JoACV2;
        $JoAC3[] = 'user';
        $JoAC4 = array();
        $JoAC4[] = $this;
        $JoAC4[] = "memberRecharge";
        $JoAC0 = call_user_func_array($JoAC4, $JoAC3);
        $result = $JoAC0;
        if ($result) goto JoBodyxa;
        goto JoNextxa;
        JoBodyxa:
        return response(['code' => 0, 'info' => '创建成功', 'order_no' => $result->charge_no]);
        goto Jox9;
        JoNextxa:
        return response(['code' => 1, 'info' => '创建失败请重试']);
        Jox9:
        goto Jox3;
        JoNextx4:
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $validate;
        $JoAC2[] = "errors";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $JoAC4 = array();
        $JoAC4[] = 'money';
        $JoAC5 = array();
        $JoAC5[] = $JoAC0;
        $JoAC5[] = "has";
        $JoAC3 = call_user_func_array($JoAC5, $JoAC4);
        if ($JoAC3) goto JoBodyxc;
        goto JoNextxc;
        JoBodyxc:
        return response(['code' => 1, 'info' => '请选择充值金额']);
        goto Joxb;
        JoNextxc:
        return response(['code' => 1, 'info' => '参数错误']);
        Joxb:Jox3:
    }

    public function pay(Request $request)
    {
        $charge_no = $request->charge_no;
        $type = $request->pay_type;
        $Jo0 = !$charge_no;
        if ($Jo0) goto JoBodyxe;
        goto JoNextxe;
        JoBodyxe:
        return redirect(url('/member/charge'));
        goto Joxd;
        JoNextxe:
        $charge_info = MemberCharge::where(['charge_no' => $charge_no, 'status' => 0])->first();
        $Jo0 = !$charge_info;
        if ($Jo0) goto JoBodyxg;
        goto JoNextxg;
        JoBodyxg:
        return redirect(url('/member/charge'));
        goto Joxf;
        JoNextxg:
        $Jo0 = $type == 'alipay';
        if ($Jo0) goto JoBodyxi;
        goto JoNextxi;
        JoBodyxi:
        $JoAC1 = array();
        $JoAC1[] =& $charge_info;
        $JoAC2 = array();
        $JoAC2[] = $this;
        $JoAC2[] = "alipay";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        return $JoAC0;
        goto Joxh;
        JoNextxi:
        $JoAC1 = array();
        $JoAC1[] =& $charge_info;
        $JoAC2 = array();
        $JoAC2[] = $this;
        $JoAC2[] = "wechat";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        return $JoAC0;
        Joxh:Joxf:Joxd:
    }

    public function alipay($charge_no)
    {
        $Jo0 = !$charge_no;
        if ($Jo0) goto JoBodyxk;
        goto JoNextxk;
        JoBodyxk:
        return redirect(url('/member/finance/pay'));
        goto Joxj;
        JoNextxk:
        $charge_info = MemberCharge::where(['charge_no' => $charge_no, 'status' => 0])->first();
        $JoAC0 = array();
        $JoAC0['out_trade_no'] = $charge_info->charge_no;
        $JoAC0['total_amount'] = $charge_info->money;
        $JoAC0['subject'] = $charge_info->mark;
        $order = $JoAC0;
        $config = config('pay.alipay');
        $this->config = $config;
        return Pay::alipay($this->config)->web($order)->send();
        Joxj:
    }

    public function wechat(Request $request)
    {
        $charge_no = $request->charge_no;
        $Jo0 = !$charge_no;
        if ($Jo0) goto JoBodyxm;
        goto JoNextxm;
        JoBodyxm:
        return redirect(url('/advert/member/charge'));
        goto Joxl;
        JoNextxm:
        $charge_info = MemberCharge::where(['charge_no' => $charge_no, 'status' => 0])->first();
        $JoAC0 = array();
        $JoAC0['out_trade_no'] = $charge_info->charge_no;
        $JoAC0['body'] = $charge_info->mark;
        $Jo0 = $charge_info->money * 100;
        $JoAC0['total_fee'] = $Jo0;
        $order = $JoAC0;
        $money = $charge_info->money;
        $this->config = config('pay.wechat');
        $result = Pay::wechat($this->config)->scan($order);
        Joxl:
    }
}

?>