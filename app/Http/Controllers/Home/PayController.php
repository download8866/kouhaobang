<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:42:50
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Home;

use App\Models\MemberCharge;
use App\Models\MemberFinance;
use App\Models\PayLog;
use App\Traits\Financial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yansongda\LaravelPay\Facades\Pay;

class PayController extends Controller
{
    use Financial;

    public function aliNotify(Request $request)
    {
        Log::info('支付宝回调：' . json_encode($request->all()));
        $this->config = config('pay.alipay');
        $alipay = Pay::alipay($this->config);
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $alipay;
        $JoAC2[] = "verify";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $data = $JoAC0;
        $exist = MemberCharge::where(['charge_no' => $data['out_trade_no'], 'status' => 0])->first();
        $Jo0 = $data['trade_status'] == 'TRADE_SUCCESS';
        $Jo1 = (bool)$Jo0;
        if ($Jo1) goto JoBodyx3;
        goto JoNextx3;
        JoBodyx3:
        $Jo1 = (bool)$exist;
        goto Jox2;
        JoNextx3:Jox2:
        if ($Jo1) goto JoBodyx4;
        goto JoNextx4;
        JoBodyx4:
        DB::beginTransaction();
        $orderLog = PayLog::create(['order_no' => $data['out_trade_no'], 'pay_way' => 'zfb']);
        $Jo0 = $data['trade_status'] == 'TRADE_SUCCESS';
        $Jo2 = (bool)$Jo0;
        if ($Jo2) goto JoBodyx7;
        goto JoNextx7;
        JoBodyx7:
        $Jo1 = $data['total_amount'] == $exist->money;
        $Jo2 = (bool)$Jo1;
        goto Jox6;
        JoNextx7:Jox6:
        if ($Jo2) goto JoBodyx8;
        goto JoNextx8;
        JoBodyx8:
        $pay_time = Carbon::now();
        $exist->status = 1;
        $exist->pay_at = $pay_time;
        $exist->pay_id = $orderLog->id;
        $exist->money = $data['total_amount'];
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $exist;
        $JoAC2[] = "save";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $charge_update = $JoAC0;
        $resilt = $this->memberFinanceCharge($exist->mid, $data['total_amount'], $orderLog->id, $data['out_trade_no']);
        $orderLog->pay_money = $data['total_amount'];
        $orderLog->result = json_encode($data);
        $orderLog->status = 1;
        $orderLog->pay_time = Carbon::now();
        $orderLog->buy_id = $data['buyer_id'];
        $orderLog->recharge_type = 1;
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $orderLog;
        $JoAC2[] = "save";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $log_result = $JoAC0;
        $Jo0 = (bool)$charge_update;
        if ($Jo0) goto JoBodyxd;
        goto JoNextxd;
        JoBodyxd:
        $Jo0 = (bool)$resilt;
        goto Joxc;
        JoNextxd:Joxc:
        $Jo1 = (bool)$Jo0;
        if ($Jo1) goto JoBodyxb;
        goto JoNextxb;
        JoBodyxb:
        $Jo1 = (bool)$log_result;
        goto Joxa;
        JoNextxb:Joxa:
        if ($Jo1) goto JoBodyxe;
        goto JoNextxe;
        JoBodyxe:
        DB::commit();
        goto Jox9;
        JoNextxe:
        DB::rollBack();
        Jox9:
        goto Jox5;
        JoNextx8:Jox5:
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $alipay;
        $JoAC2[] = "success";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        return $JoAC0;
        goto Jox1;
        JoNextx4:Jox1:
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $alipay;
        $JoAC2[] = "success";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        return $JoAC0;
    }

    public function wechatNotify(Request $request)
    {
        Log::info('微信回调：' . json_encode($request->all()));
        $this->config = config('pay.wechat');
        $pay = Pay::wechat($this->config);
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $pay;
        $JoAC2[] = "verify";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $data = $JoAC0;
        $exist = MemberCharge::where(['charge_no' => $data['out_trade_no']])->first();
        $Jo0 = $data['return_code'] == 'SUCCESS';
        $Jo1 = (bool)$Jo0;
        if ($Jo1) goto JoBodyxh;
        goto JoNextxh;
        JoBodyxh:
        $Jo1 = (bool)$exist;
        goto Joxg;
        JoNextxh:Joxg:
        if ($Jo1) goto JoBodyxi;
        goto JoNextxi;
        JoBodyxi:
        DB::beginTransaction();
        $orderLog = PayLog::create(['order_no' => $data['out_trade_no'], 'pay_way' => 'wechat']);
        $Jo0 = $data['result_code'] == 'SUCCESS';
        $Jo3 = (bool)$Jo0;
        if ($Jo3) goto JoBodyxl;
        goto JoNextxl;
        JoBodyxl:
        $Jo1 = $data['total_fee'] / 100;
        $Jo2 = $exist->money == $Jo1;
        $Jo3 = (bool)$Jo2;
        goto Joxk;
        JoNextxl:Joxk:
        if ($Jo3) goto JoBodyxm;
        goto JoNextxm;
        JoBodyxm:
        $pay_time = Carbon::now();
        $exist->status = 1;
        $exist->pay_at = $pay_time;
        $exist->pay_id = $orderLog->id;
        $Jo0 = $data['total_fee'] / 100;
        $exist->money = $Jo0;
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $exist;
        $JoAC2[] = "save";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $charge_update = $JoAC0;
        $resilt = $this->memberFinanceCharge($exist->mid, $data['total_amount'], $orderLog->id);
        $Jo0 = $data['total_fee'] / 100;
        $orderLog->pay_money = $Jo0;
        $orderLog->result = json_encode($data);
        $orderLog->status = 1;
        $orderLog->pay_time = Carbon::now();
        $orderLog->buy_id = $data['openid'];
        $orderLog->recharge_type = 1;
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $orderLog;
        $JoAC2[] = "save";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $log_result = $JoAC0;
        $Jo0 = (bool)$charge_update;
        if ($Jo0) goto JoBodyxr;
        goto JoNextxr;
        JoBodyxr:
        $Jo0 = (bool)$resilt;
        goto Joxq;
        JoNextxr:Joxq:
        $Jo1 = (bool)$Jo0;
        if ($Jo1) goto JoBodyxp;
        goto JoNextxp;
        JoBodyxp:
        $Jo1 = (bool)$log_result;
        goto Joxo;
        JoNextxp:Joxo:
        if ($Jo1) goto JoBodyxs;
        goto JoNextxs;
        JoBodyxs:
        DB::commit();
        goto Joxn;
        JoNextxs:
        DB::rollBack();
        Joxn:
        goto Joxj;
        JoNextxm:Joxj:
        goto Joxf;
        JoNextxi:Joxf:
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $pay;
        $JoAC2[] = "success";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        return $JoAC0;
    }

    public function success(Request $request)
    {
        $JoAC1 = array();
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "all";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $info = $JoAC0;
        return view('home.common.success', compact('info'));
    }
}

?>