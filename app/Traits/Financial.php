<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:44:33
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Traits;

use App\Models\MemberCharge;
use App\Models\MemberFinance;
use App\Models\OrderActive;
use App\Models\SarticleOrder;
use App\Models\Website;
use Illuminate\Support\Carbon;

trait Financial
{
    public function chargeNumber($format = 'YmdHisu', $utimestamp = null)
    {
        if (is_null($utimestamp)) goto EpBodyx2;
        goto EpNextx2;
        EpBodyx2:
        $utimestamp = microtime(true);
        goto Epx1;
        EpNextx2:Epx1:
        $A_____A_ = "floor";
        $EpAC0 = $A_____A_($utimestamp);
        $timestamp = $EpAC0;
        $A_____AA = "round";
        $EpAC0 = $A_____AA(($utimestamp - $timestamp) * 1000);
        $milliseconds = $EpAC0;
        $A____A__ = "date";
        $EpAC0 = $A____A__(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
        return $EpAC0;
    }

    public function memberRecharge($mid, $money, $pay_type, $source)
    {
        $EpAC1 = array();
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "chargeNumber";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        $charge_no = $EpAC0;
        return MemberCharge::create(['mid' => $mid, 'charge_no' => $charge_no, 'money' => $money, 'status' => 0, 'pay_type' => $pay_type, 'mark' => $source == 'user' ? ('用户前台进行充值') : '后台管理员进行充值',]);
    }

    public function chargeStatus($id, $status, $pay_id)
    {
        $charge = MemberCharge::where('id', $id)->first();
        $charge->status = $status;
        $charge->pay_at = Carbon::now();
        $charge->pay_id = $pay_id;
        $EpAC1 = array();
        $EpAC2 = array();
        $EpAC2[] = $charge;
        $EpAC2[] = "save";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
    }

    public function memberFinanceCharge($mid, $money, $pay_id, $order_no)
    {
        $website = Website::find(1);
        $record = MemberFinance::where('mid', $mid)->orderBy('id', 'desc')->first();
        $result = MemberFinance::create(['mid' => $mid, 'money' => $money, 'type' => 2, 'order_no' => $order_no, 'total_money' => $record ? ($record->total_money + $money) : $money, 'mark' => '余额充值', 'product_name' => $website->company, 'pay_id' => $pay_id]);
        return $result;
    }

    public function memberFinanceToOrder($mid, $money, $product_name, $mark, $order_id, $order_type, $order_no)
    {
        $record = MemberFinance::where('mid', $mid)->orderBy('id', 'desc')->first();
        if ($record) goto EpBodyx4;
        goto EpNextx4;
        EpBodyx4:
        $result = MemberFinance::create(['mid' => $mid, 'money' => $money, 'type' => 1, 'total_money' => $record->total_money - $money, 'mark' => $mark, 'product_name' => $product_name, 'order_id' => $order_id, 'order_type' => $order_type, 'order_no' => $order_no,]);
        goto Epx3;
        EpNextx4:
        $result = false;
        Epx3:
        return $result;
    }

    public function memberFinanceToBack($mid, $money, $product_name, $mark, $order_id, $order_type, $order_no)
    {
        $record = MemberFinance::where('mid', $mid)->orderBy('id', 'desc')->first();
        if ($record) goto EpBodyx6;
        goto EpNextx6;
        EpBodyx6:
        $result = MemberFinance::create(['mid' => $mid, 'money' => $money, 'type' => 3, 'total_money' => $record->total_money + $money, 'mark' => $mark, 'product_name' => $product_name, 'order_id' => $order_id, 'order_type' => $order_type, 'order_no' => $order_no,]);
        goto Epx5;
        EpNextx6:
        $result = false;
        Epx5:
        return $result;
    }

    public function adminRecharge($mid, $money, $order_no, $pay_id, $uid)
    {
        $website = Website::find(1);
        $record = MemberFinance::where('mid', $mid)->orderBy('id', 'desc')->first();
        $result = MemberFinance::create(['mid' => $mid, 'money' => $money, 'type' => 4, 'total_money' => $record ? ($record->total_money + $money) : $money, 'mark' => '余额充值', 'product_name' => $website->company, 'order_no' => $order_no, 'pay_id' => $pay_id, 'uid' => $uid,]);
        return $result;
    }

    public function orderInsert($mid, $order_no, $item, $mark = null, $active_id)
    {
        return SarticleOrder::create(['mid' => $mid, 'order_no' => $order_no, 'sarticle_id' => $item->id, 'price' => $item->price, 'expire_time' => date('Y-m-d H:i:s', time() + 1800), 'mark' => $mark, 'active_id' => $active_id,]);
    }

    public function activeInsert($mid, $request)
    {
        return OrderActive::create(['title' => $request->title, 'mid' => $mid, 'reference_url' => $request->link ?? '', 'content' => $request->content, 'mark' => $request->mark ?? '', 'random' => '1' . rand(1325684, 9999999), 'path' => $request->path ?? '', 'upload_name' => $request->upload_name ?? '', 'action_type' => $request->action_type ?? 'now', 'start_time' => $request->start_time ?? Carbon::now(), 'end_time' => $request->end_time ?? Carbon::now(),]);
    }

    public function orderToPay($mid, $id, $pay_id)
    {
        $order = SarticleOrder::where(['id' => $id, 'mid' => $mid, 'status' => 1])->where('expire_time', '>', Carbon::now())->first();
        if ($order) goto EpBodyx8;
        goto EpNextx8;
        EpBodyx8:
        $order->status = 2;
        $order->pay_time = Carbon::now();
        $order->pay_id = $pay_id;
        $order->pay_way = 3;
        $EpAC1 = array();
        $EpAC2 = array();
        $EpAC2[] = $order;
        $EpAC2[] = "save";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        return $EpAC0;
        goto Epx7;
        EpNextx8:
        return false;
        Epx7:
    }
}
