<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-02 12:33:26
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Admin;

use App\Models\Icon;
use App\Models\Member;
use App\Models\MemberFinance;
use App\Models\MyApply;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Sarticle;
use App\Models\SarticleOrder;
use App\Models\User;
use App\Models\Version;
use App\Traits\ApplyZip;
use App\Traits\curlPost;
use App\Traits\Sms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    use curlPost, Sms, ApplyZip;

    public function layout()
    {
        return view('admin.layout');
    }

    public function index()
    {
        $LyAC1 = array();
        $LyAC2 = array();
        $LyAC2[] = $this;
        $LyAC2[] = "getNewVersion";
        $LyAC0 = call_user_func_array($LyAC2, $LyAC1);
        $online = $LyAC0;
        $Ly0 = config('yun.ticket') . '/api/v4/oem/push';
        $LyAC2 = array();
        $LyAC2[] =& $Ly0;
        $LyAC3 = array();
        $LyAC3[] = $this;
        $LyAC3[] = "requestPost";
        $LyAC0 = call_user_func_array($LyAC3, $LyAC2);
        $data_s = $LyAC0;
        $A___AA_ = "count";
        $LyAC0 = $A___AA_($data_s['data']);
        if ($LyAC0) goto LyBodyx2;
        goto LyNextx2;
        LyBodyx2:
        $khb_notice = $data_s['data'];
        goto Lyx1;
        LyNextx2:
        $LyAC0 = array();
        $khb_notice = $LyAC0;
        Lyx1:
        $Ly0 = $online['code'] == 200;
        if ($Ly0) goto LyBodyx4;
        goto LyNextx4;
        LyBodyx4:
        $new_version = $online['data']['version'];
        goto Lyx3;
        LyNextx4:
        $new_version = '4.00';
        Lyx3:
        $latest = Version::where('slug', 'basic')->orderBy('id', 'desc')->first();
        $Ly3 = (bool)isset($latest);
        if ($Ly3) goto LyBodyx9;
        goto LyNextx9;
        LyBodyx9:
        $Ly0 = $latest->version != $new_version;
        $Ly2 = (bool)$Ly0;
        $Ly4 = !$Ly2;
        if ($Ly4) goto LyBodyx7;
        goto LyNextx7;
        LyBodyx7:
        $Ly1 = $latest->download == 0;
        $Ly2 = (bool)$Ly1;
        goto Lyx6;
        LyNextx7:Lyx6:
        $Ly3 = (bool)$Ly2;
        goto Lyx8;
        LyNextx9:Lyx8:
        if ($Ly3) goto LyBodyxa;
        goto LyNextxa;
        LyBodyxa:
        $online = $online['data'];
        $Ly0 = $latest->version != $new_version;
        if ($Ly0) goto LyBodyxc;
        goto LyNextxc;
        LyBodyxc:
        $data['version'] = $online['version'];
        $data['slug'] = 'basic';
        $data['package'] = $online['package'];
        $data['file'] = $online['file_url'];
        $data['download'] = 0;
        $data['install'] = 0;
        $data['content'] = $online['content'];
        $Ly0 = public_path() . '/file/';
        $Ly1 = $Ly0 . $online['package'];
        $data['local_path'] = $Ly1;
        $install = Version::create($data);
        goto Lyxb;
        LyNextxc:
        $install = $latest;
        Lyxb:
        goto Lyx5;
        LyNextxa:
        $install = '';
        Lyx5:
        $LyAC1 = array();
        $LyAC2 = array();
        $LyAC2[] = $this;
        $LyAC2[] = "index_data";
        $LyAC0 = call_user_func_array($LyAC2, $LyAC1);
        $data = $LyAC0;
        return view('admin.index.index', compact('data', 'install', 'khb_notice'));
    }

    public function index_data()
    {
        if (MyApply::where(['tag' => 'sarticle', 'status' => 1])->first()) goto LyBodyxe;
        goto LyNextxe;
        LyBodyxe:
        $product['total'] = Sarticle::count();
        $product['up'] = Sarticle::where('status', 1)->count();
        $product['new'] = Sarticle::where('status', 0)->where('created_at', '>', date("Y-m-d", time()))->count();
        $order['wait'] = SarticleOrder::where('status', 2)->count();
        $order['accept'] = SarticleOrder::where('status', 5)->count();
        $order['complete'] = SarticleOrder::whereIn('status', [6, 7])->count();
        $order['channel'] = SarticleOrder::whereIn('status', [4, 8, 9, 10, 11])->count();
        goto Lyxd;
        LyNextxe:
        $product['total'] = 0;
        $product['up'] = 0;
        $product['new'] = 0;
        $order['wait'] = 0;
        $order['accept'] = 0;
        $order['complete'] = 0;
        $order['channel'] = 0;
        Lyxd:
        $A___AAA = "date";
        $LyAC0 = $A___AAA('Y-m-d', time());
        $dayTime = $LyAC0;
        $user['total'] = Member::count();
        $user['today'] = Member::whereDate('created_at', $dayTime)->count();
        $charge['total'] = MemberFinance::whereIn('type', [2, 4])->sum('money');
        $charge['today'] = MemberFinance::whereIn('type', [2, 4])->whereDate('created_at', $dayTime)->sum('money');
        $LyAC0 = array();
        $LyAC0['product'] = $product;
        $LyAC0['order'] = $order;
        $LyAC0['user'] = $user;
        $LyAC0['charge'] = $charge;
        return $LyAC0;
    }

    public function echart_data(Request $request)
    {
        $LyAC1 = array();
        $LyAC2 = array();
        $LyAC2[] = $this;
        $LyAC2[] = "get_weeks";
        $LyAC0 = call_user_func_array($LyAC2, $LyAC1);
        $weeks = $LyAC0;
        $LyAC0 = array();
        $data = $LyAC0;
        $LyEac1 = array();
        foreach ($weeks as $item) {
            $LyEac1[] = $item;
        };
        $Ly1i = 0;
        Lyxf:
        $A__A__A = "count";
        $LyAC0 = $A__A__A($LyEac1);
        $Ly0 = $Ly1i < $LyAC0;
        if ($Ly0) goto LyBodyxj;
        goto LyNextxj;
        LyBodyxj:
        $Ly1Key = array_keys($LyEac1);
        $Ly1Key = $Ly1Key[$Ly1i];
        $item = $LyEac1[$Ly1Key];
        $data['user'][] = Member::whereDate('created_at', $item)->count();
        $Ly0 = Member::whereDate('created_at', $item)->count();
        $Ly0 = Member::whereDate('created_at', $item)->count();
        $Ly0 = Member::whereDate('created_at', $item)->count();
        $data['charge'][] = MemberFinance::whereIn('type', [2, 4])->whereDate('created_at', $item)->sum('money');
        $Ly0 = MemberFinance::whereIn('type', [2, 4])->whereDate('created_at', $item)->sum('money');
        $Ly0 = MemberFinance::whereIn('type', [2, 4])->whereDate('created_at', $item)->sum('money');
        $Ly0 = MemberFinance::whereIn('type', [2, 4])->whereDate('created_at', $item)->sum('money');
        $A__A___ = "substr";
        $LyAC0 = $A__A___($item, 5);
        $data['week'][] = $LyAC0;
        $Ly0 = $LyAC0;
        $Ly0 = $LyAC0;
        $Ly0 = $LyAC0;
        Lyxg:
        $Ly1i++;
        goto Lyxf;
        goto Lyxi;
        LyNextxj:Lyxi:Lyxh:
        return response()->json(['code' => 0, 'data' => $data]);
    }

    function get_weeks($time = '', $format = 'Y-m-d')
    {
        $Ly0 = $time != '';
        if ($Ly0) goto LyBodyxl;
        goto LyNextxl;
        LyBodyxl:
        $Ly1 = $time;
        goto Lyxk;
        LyNextxl:
        $A__A_A_ = "time";
        $LyAC0 = $A__A_A_();
        $Ly1 = $LyAC0;
        Lyxk:
        $time = $Ly1;
        $A__A_AA = "date";
        $LyAC0 = $A__A_AA('w', $time);
        $week = $LyAC0;
        $LyAC0 = array();
        $date = $LyAC0;
        $i = 1;
        Lyxm:
        $Ly0 = $i <= 7;
        if ($Ly0) goto LyBodyxq;
        goto LyNextxq;
        LyBodyxq:
        $A__AA__ = "date";
        $LyAC0 = $A__AA__($format, strtotime('+' . $i - $week . ' days', $time));
        $date[$i] = $LyAC0;
        Lyxn:
        $i++;
        goto Lyxm;
        goto Lyxp;
        LyNextxq:Lyxp:Lyxo:
        return $date;
    }

    public function index1()
    {
        return view('admin.index.index1');
    }

    public function index2()
    {
        return view('admin.index.index2');
    }

    public function data2(Request $request)
    {
        $res = Version::orderBy('id', 'desc')->paginate($request->get('limit', 30))->toArray();
        $LyAC0 = array();
        $LyAC0['code'] = 0;
        $LyAC0['msg'] = '正在请求中...';
        $LyAC0['count'] = $res['total'];
        $LyAC0['data'] = $res['data'];
        $data = $LyAC0;
        return response()->json($data);
    }

    public function data(Request $request)
    {
        $LyAC1 = array();
        $LyAC1[] = 'model';
        $LyAC2 = array();
        $LyAC2[] = $request;
        $LyAC2[] = "get";
        $LyAC0 = call_user_func_array($LyAC2, $LyAC1);
        $model = $LyAC0;
        $A__AA_A = "strtolower";
        $LyAC0 = $A__AA_A($model);
        $LySwitchxr = $LyAC0;
        $Ly0 = $LySwitchxr == 'user';
        if ($Ly0) goto LyBodyx14;
        goto LyNextx14;
        LyBodyx14:
        goto LyCasexs;
        goto Lyx13;
        LyNextx14:Lyx13:
        $Ly0 = $LySwitchxr == 'role';
        if ($Ly0) goto LyBodyx12;
        goto LyNextx12;
        LyBodyx12:
        goto LyCasext;
        goto Lyx11;
        LyNextx12:Lyx11:
        $Ly0 = $LySwitchxr == 'permission';
        if ($Ly0) goto LyBodyxz;
        goto LyNextxz;
        LyBodyxz:
        goto LyCasexu;
        goto Lyxy;
        LyNextxz:Lyxy:
        goto LyDefaultAfterxv;
        $Ly1 = !$LySwitchxr;
        if ($Ly1) goto LyBodyxx;
        goto LyNextxx;
        LyBodyxx:
        goto LyDefaultxv;
        goto Lyxw;
        LyNextxx:Lyxw:LyDefaultAfterxv:
        goto LyDefaultxv;
        goto Lyxr;
        LyCasexs:
        $Ly0 = new User();
        $query = $Ly0;
        goto Lyxr;
        LyCasext:
        $Ly0 = new Role();
        $query = $Ly0;
        goto Lyxr;
        LyCasexu:
        $Ly0 = new Permission();
        $query = $Ly0;
        $query = $query->where('parent_id', $request->get('parent_id', 0))->with('icon');
        goto Lyxr;
        LyDefaultxv:
        $Ly0 = new User();
        $query = $Ly0;
        goto Lyxr;
        Lyxr:
        $res = $query->paginate($request->get('limit', 30))->toArray();
        $LyAC0 = array();
        $LyAC0['code'] = 0;
        $LyAC0['msg'] = '正在请求中...';
        $LyAC0['count'] = $res['total'];
        $LyAC0['data'] = $res['data'];
        $data = $LyAC0;
        return response()->json($data);
    }

    public function icons()
    {
        $icons = Icon::orderBy('sort', 'desc')->get();
        return response()->json(['code' => 0, 'msg' => '请求成功', 'data' => $icons]);
    }

    public function download(Request $request)
    {
        $exist = Version::where(['id' => $request->id, 'download' => 0])->first();
        if ($exist) goto LyBodyx16;
        goto LyNextx16;
        LyBodyx16:
        $A__AAA_ = "unlink";
        $LyAC0 = $A__AAA_(base_path() . '/bootstrap/cache/packages.php');
        $A__AAAA = "unlink";
        $LyAC0 = $A__AAAA(base_path() . '/bootstrap/cache/services.php');
        $order = $this->renewal($exist->file, $exist->package);
        if ($order['file_name']) goto LyBodyx18;
        goto LyNextx18;
        LyBodyx18:
        $this->renewalInstall($exist->id, $exist->package);
        unlink(public_path() . '/file/' . $exist->package);
        exec('php /' . base_path() . '/artisan cache:clear');
        return response(['code' => 0, 'info' => '更新成功']);
        goto Lyx17;
        LyNextx18:
        return response(['code' => 1, 'info' => '更新失败请重装']);
        Lyx17:
        goto Lyx15;
        LyNextx16:
        $LyAC0 = array();
        $LyAC0['code'] = 1;
        $LyAC0['info'] = '已经是最新版本了';
        return $LyAC0;
        Lyx15:
    }

    public function getNewVersion()
    {
        $Ly0 = $this->postUrl . '/api/sys/version';
        $url = $Ly0;
        $LyAC1 = array();
        $LyAC1[] =& $url;
        $LyAC2 = array();
        $LyAC2[] = $this;
        $LyAC2[] = "requestGet";
        $LyAC0 = call_user_func_array($LyAC2, $LyAC1);
        $version = $LyAC0;
        return $version;
    }
}

?>