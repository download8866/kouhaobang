<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-02 13:32:18
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Admin;

use App\Models\Dictionary;
use App\Models\MyApply;
use App\Models\MyPart;
use App\Models\MyTemplate;
use App\Models\Permission;
use App\Models\Secret;
use App\Models\Version;
use App\Traits\ApplyZip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MyApplyController extends Controller
{
    use ApplyZip;

    public function index()
    {
        return view('admin.my_apply.index');
    }

    public function template()
    {
        $data = MyTemplate::all();
        return view('admin.my_apply.template', compact('data'));
    }

    public function part()
    {
        $data = MyPart::all();
        return view('admin.my_apply.part', compact('data'));
    }

    public function data(Request $request, MyApply $model)
    {
        $res = $model->orderBy('created_at', 'desc')->paginate($request->get('limit', 30))->toArray();
        $S11AC0 = array();
        $S11AC0['code'] = 0;
        $S11AC0['msg'] = '正在请求中...';
        $S11AC0['count'] = $res['total'];
        $S11AC0['data'] = $res['data'];
        $data = $S11AC0;
        return response()->json($data);
    }

    public function installTemplate(Request $request)
    {
        $id = $request->id;
        $info = MyTemplate::where('id', $id)->first();
        if ($info) goto S11Bodyx2;
        goto S11Nextx2;
        S11Bodyx2:
        $info->status = 1;
        $S11AC1 = array();
        $S11AC2 = array();
        $S11AC2[] = $info;
        $S11AC2[] = "save";
        $S11AC0 = call_user_func_array($S11AC2, $S11AC1);
        MyTemplate::where('id', '!=', $id)->update(['status' => 0]);
        return response(['code' => 0, 'info' => '处理成功']);
        goto S11x1;
        S11Nextx2:
        return response(['code' => 1, 'info' => '非法请求']);
        S11x1:
    }

    public function installApply(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $info = MyApply::where('id', $id)->first();
        DB::beginTransaction();
        $S110 = $info->tag == 'sarticle';
        if ($S110) goto S11Bodyx4;
        goto S11Nextx4;
        S11Bodyx4:
        $info->status = $status;
        $S11AC1 = array();
        $S11AC2 = array();
        $S11AC2[] = $info;
        $S11AC2[] = "save";
        $S11AC0 = call_user_func_array($S11AC2, $S11AC1);
        $S110 = $status == 1;
        if ($S110) goto S11Bodyx6;
        goto S11Nextx6;
        S11Bodyx6:
        $sarticle = Permission::where('id', 52)->update(['status' => 0]);
        $order = Permission::where('id', 83)->update(['status' => 0]);
        $dictionary = Dictionary::whereIn('id', [1, 2, 3, 4, 7, 8, 9, 10])->update(['status' => 1]);
        $S110 = (bool)$sarticle;
        if ($S110) goto S11Bodyxb;
        goto S11Nextxb;
        S11Bodyxb:
        $S110 = (bool)$order;
        goto S11xa;
        S11Nextxb:S11xa:
        $S111 = (bool)$S110;
        if ($S111) goto S11Bodyx9;
        goto S11Nextx9;
        S11Bodyx9:
        $S111 = (bool)$dictionary;
        goto S11x8;
        S11Nextx9:S11x8:
        if ($S111) goto S11Bodyxc;
        goto S11Nextxc;
        S11Bodyxc:
        DB::commit();
        return response(['code' => 0, 'info' => '处理成功']);
        goto S11x7;
        S11Nextxc:
        DB::rollBack();
        return response(['code' => 1, 'info' => '处理失败']);
        S11x7:
        goto S11x5;
        S11Nextx6:
        $S110 = $status == 0;
        if ($S110) goto S11Bodyxd;
        goto S11Nextxd;
        S11Bodyxd:
        $sarticle = Permission::where('id', 52)->update(['status' => 1]);
        $order = Permission::where('id', 83)->update(['status' => 1]);
        $dictionary = Dictionary::whereIn('id', [1, 2, 3, 4, 7, 8, 9, 10])->update(['status' => 0]);
        $S110 = (bool)$sarticle;
        if ($S110) goto S11Bodyxi;
        goto S11Nextxi;
        S11Bodyxi:
        $S110 = (bool)$order;
        goto S11xh;
        S11Nextxi:S11xh:
        $S111 = (bool)$S110;
        if ($S111) goto S11Bodyxg;
        goto S11Nextxg;
        S11Bodyxg:
        $S111 = (bool)$dictionary;
        goto S11xf;
        S11Nextxg:S11xf:
        if ($S111) goto S11Bodyxj;
        goto S11Nextxj;
        S11Bodyxj:
        DB::commit();
        return response(['code' => 0, 'info' => '处理成功']);
        goto S11xe;
        S11Nextxj:
        DB::rollBack();
        return response(['code' => 1, 'info' => '处理失败']);
        S11xe:
        goto S11x5;
        S11Nextxd:
        return response(['code' => 1, 'info' => '处理失败']);
        S11x5:
        goto S11x3;
        S11Nextx4:
        return response(['code' => 1, 'info' => '暂不支持其他类型']);
        S11x3:
    }

    public function installPart(Request $request)
    {
        $id = $request->id;
        $info = MyPart::where('id', $id)->first();
        $status = $request->status;
        if ($info) goto S11Bodyxl;
        goto S11Nextxl;
        S11Bodyxl:
        $info->status = $status;
        $S11AC1 = array();
        $S11AC2 = array();
        $S11AC2[] = $info;
        $S11AC2[] = "save";
        $S11AC0 = call_user_func_array($S11AC2, $S11AC1);
        $S110 = $status == 1;
        if ($S110) goto S11Bodyxn;
        goto S11Nextxn;
        S11Bodyxn:
        MyPart::where('id', '!=', $id)->update(['status' => 0]);
        goto S11xm;
        S11Nextxn:S11xm:
        return response(['code' => 0, 'info' => '处理成功']);
        goto S11xk;
        S11Nextxl:
        return response(['code' => 1, 'info' => '非法请求']);
        S11xk:
    }

    public function applyUpdate(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        $S110 = $type == 'apply';
        if ($S110) goto S11Bodyxp;
        goto S11Nextxp;
        S11Bodyxp:
        $u = 'api/v4/apply';
        $info = MyApply::find($id);
        goto S11xo;
        S11Nextxp:
        $S110 = $type == 'template';
        if ($S110) goto S11Bodyxq;
        goto S11Nextxq;
        S11Bodyxq:
        $u = 'api/v4/template';
        $info = MyTemplate::find($id);
        goto S11xo;
        S11Nextxq:
        $S110 = $type == 'part';
        if ($S110) goto S11Bodyxr;
        goto S11Nextxr;
        S11Bodyxr:
        $u = 'api/v4/part';
        $info = MyPart::find($id);
        goto S11xo;
        S11Nextxr:
        return response(['code' => 1, 'info' => '非法请求']);
        S11xo:
        $result = $this->applyCurl($u, ['tag' => $info->tag, 'cate' => 2]);
        $result = json_decode(json_decode($result));
        $S110 = $result->code == 0;
        if ($S110) goto S11Bodyxt;
        goto S11Nextxt;
        S11Bodyxt:
        if (count($result->data)) goto S11Bodyxv;
        goto S11Nextxv;
        S11Bodyxv:
        $online = $result->data[0];
        $S110 = $online->version != $info->version;
        if ($S110) goto S11Bodyxx;
        goto S11Nextxx;
        S11Bodyxx:
        $data['version'] = $online->version;
        $data['slug'] = $type;
        $data['package'] = $online->package;
        $data['file'] = $online->file_url;
        $data['download'] = 0;
        $data['install'] = 0;
        $S110 = public_path() . '/file/';
        $S111 = $S110 . $online->package;
        $data['local_path'] = $S111;
        $install_r = Version::create($data);
        $A___AAA = "unlink";
        $S11AC0 = $A___AAA(base_path() . '/bootstrap/cache/packages.php');
        $A__A___ = "unlink";
        $S11AC0 = $A__A___(base_path() . '/bootstrap/cache/services.php');
        $order = $this->renewal($online->file_url, $online->package);
        if ($order['file_name']) goto S11Bodyxz;
        goto S11Nextxz;
        S11Bodyxz:
        $this->renewalInstall($install_r->id, $online->package);
        $A__A__A = "substr";
        $S11AC1 = $A__A__A($data['local_path'], 0, -4);
        $S11AC2 = array();
        $S11AC2[] =& $S11AC1;
        $S11AC3 = array();
        $S11AC3[] = $this;
        $S11AC3[] = "deldir";
        $S11AC0 = call_user_func_array($S11AC3, $S11AC2);
        unlink(public_path() . '/file/' . $online->package);
        exec('php /' . base_path() . '/artisan cache:clear');
        $info->version = $online->version;
        $S11AC1 = array();
        $S11AC2 = array();
        $S11AC2[] = $info;
        $S11AC2[] = "save";
        $S11AC0 = call_user_func_array($S11AC2, $S11AC1);
        return response(['code' => 0, 'info' => '更新成功']);
        goto S11xy;
        S11Nextxz:
        return response(['code' => 1, 'info' => '下载失败请重新下载']);
        S11xy:
        goto S11xw;
        S11Nextxx:
        return response(['code' => 0, 'info' => '已是最新版本了']);
        S11xw:
        goto S11xu;
        S11Nextxv:
        return response(['code' => 0, 'info' => '已是最新版本了']);
        S11xu:
        goto S11xs;
        S11Nextxt:
        return response(['code' => 1, 'info' => '请求失败']);
        S11xs:
    }

    public function applyCurl($u, $data)
    {
        $S110 = config('yun.apply') . $u;
        $url = $S110;
        $secret = Secret::find(1);
        $data['appKey'] = $secret->key;
        $data['appSecret'] = $secret->secret;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $data = curl_exec($ch);
        if (curl_errno($ch)) goto S11Bodyx12;
        goto S11Nextx12;
        S11Bodyx12:
        return curl_error($ch);
        goto S11x11;
        S11Nextx12:S11x11:
        curl_close($ch);
        return json_encode($data);
    }
}

?>