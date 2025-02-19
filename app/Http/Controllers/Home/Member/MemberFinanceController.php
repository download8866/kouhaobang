<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:42:50
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Home\Member;

use App\Models\MemberFinance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class MemberFinanceController extends Controller
{
    public function index()
    {
        $menu = "finance";
        return view('home.member.finance.index', compact('menu'));
    }

    public function data(Request $request)
    {
        $JoAC1 = array();
        $JoAC1[] =& $request;
        $JoAC2 = array();
        $JoAC2[] = $this;
        $JoAC2[] = "getData";
        $JoAC0 = call_user_func_array($JoAC2, $JoAC1);
        $list = $JoAC0;
        return response()->json(['total' => $list['total'], 'data' => $list['data']]);
    }

    public function getData($request)
    {
        $model = MemberFinance::query();
        if ($request->order_type) goto JoBodyx2;
        goto JoNextx2;
        JoBodyx2:
        $model = $model->where('order_type', $request->order_type);
        goto Jox1;
        JoNextx2:Jox1:
        if ($request->type) goto JoBodyx4;
        goto JoNextx4;
        JoBodyx4:
        $Jo0 = $request->type == 2;
        if ($Jo0) goto JoBodyx6;
        goto JoNextx6;
        JoBodyx6:
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
        goto Jox5;
        JoNextx6:
        $model = $model->where('type', $request->type);
        Jox5:
        goto Jox3;
        JoNextx4:Jox3:
        $list = $model->where('mid', auth('member')->user()->id)->orderBy('id', 'desc')->paginate($request->get('limit', 30))->toArray();
        $JoAC0 = array();
        $JoAC0['total'] = $list['total'];
        $JoAC0['data'] = $list['data'];
        $data = $JoAC0;
        return $data;
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
        Joxb:
        $AAA____ = "count";
        $JoAC0 = $AAA____($JoEac1);
        $Jo0 = $Jo1i < $JoAC0;
        if ($Jo0) goto JoBodyxj;
        goto JoNextxj;
        JoBodyxj:
        $Jo1Key = array_keys($JoEac1);
        $Jo1Key = $Jo1Key[$Jo1i];
        $item = $JoEac1[$Jo1Key];
        $Jo0 = $item['type'] == 2;
        $Jo2 = (bool)$Jo0;
        $Jo3 = !$Jo2;
        if ($Jo3) goto JoBodyxl;
        goto JoNextxl;
        JoBodyxl:
        goto JoBodyxf;
        goto Joxk;
        JoNextxl:Joxk:
        goto JoNextxf;
        JoBodyxf:
        goto JoBodyx9;
        goto Joxe;
        JoNextxf:Joxe:
        goto JoNextx9;
        JoBodyx9:
        $Jo1 = $item['type'] == 4;
        $Jo2 = (bool)$Jo1;
        goto Jox8;
        JoNextx9:Jox8:
        if ($Jo2) goto JoBodyxn;
        goto JoNextxn;
        JoBodyxn:
        goto JoBodyxh;
        goto Joxm;
        JoNextxn:Joxm:
        goto JoNextxh;
        JoBodyxh:
        goto JoBodyxa;
        goto Joxg;
        JoNextxh:Joxg:
        goto JoNextxa;
        JoBodyxa:
        $symbol = "+";
        goto Jox7;
        JoNextxa:
        $symbol = "-";
        Jox7:
        $JoAC0 = array();
        $JoAC0[] = $item['order_no'];
        $JoAC0[] = $item['product_name'];
        $JoAC0[] = $item['created_at'];
        $JoAC0[] = $item['mark'];
        $Jo0 = $symbol . $item['money'];
        $JoAC0[] = $Jo0;
        $JoAC0[] = $item['total_money'];
        $JoAC0[] = '成功';
        $data[] = $JoAC0;
        $Jo0 = $JoAC0;
        $Jo0 = $JoAC0;
        $Jo1 = $JoAC0;
        Joxc:
        $Jo1i++;
        goto Joxb;
        goto Joxi;
        JoNextxj:Joxi:Joxd:
        array_unshift($data, ['订单号', '交易媒体', '交易时间', '交易说明', '交易金额', '账户余额', '交易状态']);
        $AAA___A = "date";
        $JoAC0 = $AAA___A('YmdHis');
        $Jo0 = $JoAC0 . '-财务导出';
        $title = $Jo0;
        Excel::create($title, function ($excel) use ($data) {
            $excel->sheet('财务导出', function ($sheet) use ($data) {
                $sheet->rows($data);
            });
        })->export('xls');
    }
}

?>