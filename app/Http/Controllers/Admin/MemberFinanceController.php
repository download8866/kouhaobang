<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:42:50
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\MemberFinance;
use App\Traits\Financial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MemberFinanceController extends Controller
{
    use Financial;

    public function index()
    {
        return view('admin.finance.index');
    }

    public function data(Request $request)
    {
        $JoAC1 = array();
        $JoAC1[] =& $request;
        $JoAC2 = array();
        $JoAC2[] = $this;
        $JoAC2[] = "getData";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $res = $JoAC0;
        $JoAC0 = array();
        $JoAC0['code'] = 0;
        $JoAC0['msg'] = '正在请求中...';
        $JoAC0['count'] = $res['total'];
        $JoAC0['data'] = $res['data'];
        $data = $JoAC0;
        return response()->json($data);
    }

    public function getData($request)
    {
        $model = MemberFinance::query();
        $JoAC1 = array();
        $JoAC1[] = 'type';
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "get";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        if ($JoAC0) goto JoBodyx2;
        goto JoNextx2;
        JoBodyx2:
        $JoAC1 = array();
        $JoAC1[] = 'type';
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "get";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $Jo0 = $JoAC0 == 2;
        if ($Jo0) goto JoBodyx4;
        goto JoNextx4;
        JoBodyx4:
        $JoAC1 = array();
        $JoAC1[] = 2;
        $JoAC1[] = 4;
        $JoAC2 = array();
        $JoAC2[] = 'type';
        $JoAC2[] =& $JoAC1;
        $JoAC3 = array();
        $JoAC3[] = $model;
        $JoAC3[] = "whereIn";
        $JoAC0 = call_user_func_array($JoAC3, $JoAC2);
        $model = $JoAC0;
        goto Jox3;
        JoNextx4:
        $model = $model->where('type', $request->get('type'));
        Jox3:
        goto Jox1;
        JoNextx2:Jox1:
        $JoAC1 = array();
        $JoAC1[] = 'order_type';
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "get";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        if ($JoAC0) goto JoBodyx6;
        goto JoNextx6;
        JoBodyx6:
        $model = $model->where('order_type', $request->get('order_type'));
        goto Jox5;
        JoNextx6:Jox5:
        $JoAC1 = array();
        $JoAC1[] = 'mobile';
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "get";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        if ($JoAC0) goto JoBodyx8;
        goto JoNextx8;
        JoBodyx8:
        $mobile_ids = Member::where('mobile', 'like', "%" . $request->get('mobile') . "%")->distinct('id')->pluck('id')->all();
        $JoAC1 = array();
        $JoAC1[] = 'mid';
        $JoAC1[] =& $mobile_ids;
        $JoAC2 = array();
        $JoAC2[] = $model;
        $JoAC2[] = "whereIn";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $model = $JoAC0;
        goto Jox7;
        JoNextx8:Jox7:
        $JoAC1 = array();
        $JoAC1[] = 'username';
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "get";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        if ($JoAC0) goto JoBodyxa;
        goto JoNextxa;
        JoBodyxa:
        $username_ids = Member::where('username', 'like', "%" . $request->get('username') . "%")->distinct('id')->pluck('id')->all();
        $JoAC1 = array();
        $JoAC1[] = 'mid';
        $JoAC1[] =& $username_ids;
        $JoAC2 = array();
        $JoAC2[] = $model;
        $JoAC2[] = "whereIn";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $model = $JoAC0;
        goto Jox9;
        JoNextxa:Jox9:
        $JoAC1 = array();
        $JoAC1[] = 'start_time';
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "get";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        if ($JoAC0) goto JoBodyxc;
        goto JoNextxc;
        JoBodyxc:
        $model = $model->where('created_at', '>', "%" . $request->get('start_time'));
        goto Joxb;
        JoNextxc:Joxb:
        $JoAC1 = array();
        $JoAC1[] = 'end_time';
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "get";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        if ($JoAC0) goto JoBodyxe;
        goto JoNextxe;
        JoBodyxe:
        $model = $model->where('created_at', '<=', "%" . $request->get('end_time'));
        goto Joxd;
        JoNextxe:Joxd:
        $JoAC1 = array();
        $JoAC1[] = 'ids';
        $JoAC2 = array();
        $JoAC2[] = $request;
        $JoAC2[] = "get";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        if ($JoAC0) goto JoBodyxg;
        goto JoNextxg;
        JoBodyxg:
        $model = $model->whereIn('id', explode(',', $request->get('ids')));
        goto Joxf;
        JoNextxg:Joxf:
        return $model->with('member')->orderBy('id', 'desc')->paginate($request->get('limit', 30))->toArray();
    }

    public function cloud()
    {
        return view('admin.finance.cloud');
    }

    public function cloudData()
    {
    }

    public function export(Request $request)
    {
        $list = $this->getData($request)['data'];
        $JoAC0 = array();
        $data = $JoAC0;
        $JoEac1 = array();
        foreach ($list as $item) {
            $JoEac1[] = $item;
        };
        $Jo1i = 0;
        Jox11:
        $AA_A_A_ = "count";
        $JoAC0 = $AA_A_A_($JoEac1);
        $Jo0 = $Jo1i < $JoAC0;
        if ($Jo0) goto JoBodyx1h;
        goto JoNextx1h;
        JoBodyx1h:
        $Jo1Key = array_keys($JoEac1);
        $Jo1Key = $Jo1Key[$Jo1i];
        $item = $JoEac1[$Jo1Key];
        $Jo0 = $item['member']['username'] ?? $item['member']['phone'];
        $username = $Jo0;
        $Jo0 = $item['member']['mobile'] ?? $item['member']['phone'];
        $mobile = $Jo0;
        $type = $item['type'];
        $JoSwitchxh = $type;
        $Jo0 = $JoSwitchxh == 1;
        if ($Jo0) goto JoBodyx1j;
        goto JoNextx1j;
        JoBodyx1j:
        goto JoBodyx15;
        goto Jox1i;
        JoNextx1j:Jox1i:
        goto JoNextx15;
        JoBodyx15:
        goto JoBodyxz;
        goto Jox14;
        JoNextx15:Jox14:
        goto JoNextxz;
        JoBodyxz:
        goto JoCasexi;
        goto Joxy;
        JoNextxz:Joxy:
        $Jo0 = $JoSwitchxh == 2;
        if ($Jo0) goto JoBodyx1l;
        goto JoNextx1l;
        JoBodyx1l:
        goto JoBodyx17;
        goto Jox1k;
        JoNextx1l:Jox1k:
        goto JoNextx17;
        JoBodyx17:
        goto JoBodyxx;
        goto Jox16;
        JoNextx17:Jox16:
        goto JoNextxx;
        JoBodyxx:
        goto JoCasexj;
        goto Joxw;
        JoNextxx:Joxw:
        $Jo0 = $JoSwitchxh == 3;
        if ($Jo0) goto JoBodyx1n;
        goto JoNextx1n;
        JoBodyx1n:
        goto JoBodyx19;
        goto Jox1m;
        JoNextx1n:Jox1m:
        goto JoNextx19;
        JoBodyx19:
        goto JoBodyxv;
        goto Jox18;
        JoNextx19:Jox18:
        goto JoNextxv;
        JoBodyxv:
        goto JoCasexk;
        goto Joxu;
        JoNextxv:Joxu:
        $Jo0 = $JoSwitchxh == 4;
        if ($Jo0) goto JoBodyx1p;
        goto JoNextx1p;
        JoBodyx1p:
        goto JoBodyx1b;
        goto Jox1o;
        JoNextx1p:Jox1o:
        goto JoNextx1b;
        JoBodyx1b:
        goto JoBodyxt;
        goto Jox1a;
        JoNextx1b:Jox1a:
        goto JoNextxt;
        JoBodyxt:
        goto JoCasexl;
        goto Joxs;
        JoNextxt:Joxs:
        $Jo0 = $JoSwitchxh == 5;
        if ($Jo0) goto JoBodyx1r;
        goto JoNextx1r;
        JoBodyx1r:
        goto JoBodyx1d;
        goto Jox1q;
        JoNextx1r:Jox1q:
        goto JoNextx1d;
        JoBodyx1d:
        goto JoBodyxr;
        goto Jox1c;
        JoNextx1d:Jox1c:
        goto JoNextxr;
        JoBodyxr:
        goto JoCasexm;
        goto Joxq;
        JoNextxr:Joxq:
        goto JoDefaultAfterxn;
        $Jo0 = !$JoSwitchxh;
        if ($Jo0) goto JoBodyx1t;
        goto JoNextx1t;
        JoBodyx1t:
        goto JoBodyx1f;
        goto Jox1s;
        JoNextx1t:Jox1s:
        goto JoNextx1f;
        JoBodyx1f:
        goto JoBodyxp;
        goto Jox1e;
        JoNextx1f:Jox1e:
        goto JoNextxp;
        JoBodyxp:
        goto JoDefaultxn;
        goto Joxo;
        JoNextxp:Joxo:JoDefaultAfterxn:
        goto JoDefaultxn;
        goto Joxh;
        JoCasexi:
        $type_name = "用户下单";
        goto Joxh;
        JoCasexj:
        $type_name = "用户充值";
        goto Joxh;
        JoCasexk:
        $type_name = "用户退单";
        goto Joxh;
        JoCasexl:
        $type_name = "后台充值";
        goto Joxh;
        JoCasexm:
        $type_name = "用户申请退款";
        goto Joxh;
        JoDefaultxn:
        $type_name = "用户下单";
        Joxh:
        $JoAC0 = array();
        $JoAC0[] = $username;
        $JoAC0[] = $mobile;
        $JoAC0[] = $item['money'];
        $JoAC0[] = $type_name;
        $JoAC0[] = $item['total_money'];
        $Jo0 = (string)$item['order_no'];
        $JoAC0[] = $Jo0;
        $JoAC0[] = $item['product_name'];
        $JoAC0[] = $item['mark'];
        $JoAC0[] = $item['created_at'];
        $data[] = $JoAC0;
        $Jo0 = $JoAC0;
        $Jo0 = $JoAC0;
        $Jo1 = $JoAC0;
        Jox12:
        $Jo1i++;
        goto Jox11;
        goto Jox1g;
        JoNextx1h:Jox1g:Jox13:
        array_unshift($data, ['用户名称', '用户手机', '交易金额', '交易类型', '可用余额', '订单号', '资源名称', '备注', '交易时间']);
        $AA_A_AA = "date";
        $JoAC0 = $AA_A_AA('YmdHis');
        $Jo0 = $JoAC0 . '-财务流水导出';
        $title = $Jo0;
        Excel::create($title, function ($excel) use ($data) {
            $excel->sheet('财务流水导出', function ($sheet) use ($data) {
                $sheet->rows($data);
            });
        })->export('xls');
    }

    public function create()
    {
        return view('admin.finance.create');
    }

    public function store(Request $request)
    {
        $phone = $request->phone;
        $money = $request->money;
        $member = Member::where('phone', $phone)->first();
        $uid = auth()->user()->id;
        if ($member) goto JoBodyx1v;
        goto JoNextx1v;
        JoBodyx1v:
        $AA_AA__ = "date";
        $JoAC0 = $AA_AA__('Y-m-d H:i:s', time() - 60);
        $before = $JoAC0;
        $records = MemberFinance::where('mid', $member->id)->where('created_at', '>', $before)->first();
        $Jo0 = !$records;
        if ($Jo0) goto JoBodyx1x;
        goto JoNextx1x;
        JoBodyx1x:
        DB::beginTransaction();
        $charge = $this->memberRecharge($member->id, $money, 'admin', 'admin');
        $result = $this->adminRecharge($member->id, $money, $charge->charge_no, $charge->id, $uid);
        $Jo0 = (bool)$charge;
        if ($Jo0) goto JoBodyx21;
        goto JoNextx21;
        JoBodyx21:
        $Jo0 = (bool)$result;
        goto Jox2z;
        JoNextx21:Jox2z:
        if ($Jo0) goto JoBodyx22;
        goto JoNextx22;
        JoBodyx22:
        DB::commit();
        return response(['code' => 0, 'info' => '充值成功']);
        goto Jox1y;
        JoNextx22:
        DB::rollBack();
        return response(['code' => 1, 'info' => '充值失败']);
        Jox1y:
        goto Jox1w;
        JoNextx1x:
        return response(['code' => 1, 'info' => '一分钟内不准二次充值']);
        Jox1w:
        goto Jox1u;
        JoNextx1v:
        return response(['code' => 1, 'info' => '用户不存在']);
        Jox1u:
    }
}

?>