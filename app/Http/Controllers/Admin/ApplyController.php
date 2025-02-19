<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 20:37:01
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Admin;

use App\Models\MyApply;
use App\Models\MyPart;
use App\Models\MyTemplate;
use App\Models\Secret;
use App\Models\Version;
use App\Traits\ApplyZip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplyController extends Controller
{
    use ApplyZip;

    public function index()
    {
        $u = 'api/v4/apply';
        $MtAC0 = array();
        $MtAC0['cate'] = 1;
        $conditions = $MtAC0;
        $MtAC1 = array();
        $MtAC1[] =& $u;
        $MtAC1[] =& $conditions;
        $MtAC2 = array();
        $MtAC2[] = $this;
        $MtAC2[] = "applyCurl";
        $MtAC0 = call_user_func_array($MtAC2, $MtAC1);
        $result = $MtAC0;
        $Mt0 = $result != "请先配置密钥";
        if ($Mt0) goto MtBodyx2;
        goto MtNextx2;
        MtBodyx2:
        $result = json_decode(json_decode($result));
        $MtAC0 = array();
        $data = $MtAC0;
        $Mt0 = $result->code == 0;
        if ($Mt0) goto MtBodyx4;
        goto MtNextx4;
        MtBodyx4:
        $data = $result->data;
        goto Mtx3;
        MtNextx4:Mtx3:
        $list = MyApply::all(['tag'])->toArray();
        $list = array_column($list, 'tag');
        return view('admin.apply.index', compact('data', 'list'));
        goto Mtx1;
        MtNextx2:
        return view('admin.apply.error', compact('result'));
        Mtx1:
    }

    public function template()
    {
        $u = 'api/v4/template';
        $MtAC0 = array();
        $MtAC0['cate'] = 1;
        $conditions = $MtAC0;
        $MtAC1 = array();
        $MtAC1[] =& $u;
        $MtAC1[] =& $conditions;
        $MtAC2 = array();
        $MtAC2[] = $this;
        $MtAC2[] = "applyCurl";
        $MtAC0 = call_user_func_array($MtAC2, $MtAC1);
        $result = $MtAC0;
        $Mt0 = $result != "请先配置密钥";
        if ($Mt0) goto MtBodyx6;
        goto MtNextx6;
        MtBodyx6:
        $result = json_decode(json_decode($result));
        $MtAC0 = array();
        $data = $MtAC0;
        $Mt0 = $result->code == 0;
        if ($Mt0) goto MtBodyx8;
        goto MtNextx8;
        MtBodyx8:
        $data = $result->data;
        goto Mtx7;
        MtNextx8:Mtx7:
        $list = MyTemplate::all(['tag'])->toArray();
        $list = array_column($list, 'tag');
        return view('admin.apply.template', compact('data', 'list'));
        goto Mtx5;
        MtNextx6:
        return view('admin.apply.error', compact('result'));
        Mtx5:
    }

    public function part()
    {
        $u = 'api/v4/part';
        $MtAC0 = array();
        $MtAC0['cate'] = 1;
        $conditions = $MtAC0;
        $MtAC1 = array();
        $MtAC1[] =& $u;
        $MtAC1[] =& $conditions;
        $MtAC2 = array();
        $MtAC2[] = $this;
        $MtAC2[] = "applyCurl";
        $MtAC0 = call_user_func_array($MtAC2, $MtAC1);
        $result = $MtAC0;
        $Mt0 = $result != "请先配置密钥";
        if ($Mt0) goto MtBodyxa;
        goto MtNextxa;
        MtBodyxa:
        $result = json_decode(json_decode($result));
        $MtAC0 = array();
        $data = $MtAC0;
        $Mt0 = $result->code == 0;
        if ($Mt0) goto MtBodyxc;
        goto MtNextxc;
        MtBodyxc:
        $data = $result->data;
        goto Mtxb;
        MtNextxc:Mtxb:
        $list = MyPart::all(['tag'])->toArray();
        $list = array_column($list, 'tag');
        return view('admin.apply.part', compact('data', 'list'));
        goto Mtx9;
        MtNextxa:
        return view('admin.apply.error', compact('result'));
        Mtx9:
    }

    public function data(Request $request)
    {
        $u = 'api/v4/apply';
        $MtAC0 = array();
        $MtAC2 = array();
        $MtAC2[] = 'limit';
        $MtAC3 = array();
        $MtAC3[] = $request;
        $MtAC3[] = "get";
        $MtAC1 = call_user_func_array($MtAC3, $MtAC2);
        $MtAC0['limit'] = $MtAC1;
        $MtAC5 = array();
        $MtAC5[] = 'name';
        $MtAC6 = array();
        $MtAC6[] = $request;
        $MtAC6[] = "get";
        $MtAC4 = call_user_func_array($MtAC6, $MtAC5);
        $MtAC0['name'] = $MtAC4;
        $MtAC8 = array();
        $MtAC8[] = 'page';
        $MtAC9 = array();
        $MtAC9[] = $request;
        $MtAC9[] = "get";
        $MtAC7 = call_user_func_array($MtAC9, $MtAC8);
        $MtAC0['page'] = $MtAC7;
        $conditions = $MtAC0;
        $MtAC1 = array();
        $MtAC1[] =& $u;
        $MtAC1[] =& $conditions;
        $MtAC2 = array();
        $MtAC2[] = $this;
        $MtAC2[] = "applyCurl";
        $MtAC0 = call_user_func_array($MtAC2, $MtAC1);
        $result = $MtAC0;
        $result = json_decode(json_decode($result));
        $Mt0 = $result->code == 200;
        if ($Mt0) goto MtBodyxe;
        goto MtNextxe;
        MtBodyxe:
        $data_s = $result->data;
        $MtAC0 = array();
        $MtAC0['code'] = 0;
        $MtAC0['msg'] = '正在请求中...';
        $MtAC0['count'] = $data_s->total;
        $MtAC0['data'] = $data_s->data;
        $data = $MtAC0;
        goto Mtxd;
        MtNextxe:
        $MtAC0 = array();
        $MtAC0['code'] = 201;
        $MtAC0['msg'] = $result->info;
        $MtAC0['count'] = 0;
        $MtAC2 = array();
        $MtAC0['data'] = $MtAC2;
        $data = $MtAC0;
        Mtxd:
        return response()->json($data);
    }

    public function applyCurl($u, $data)
    {
        $Mt0 = config('yun.apply') . $u;
        $url = $Mt0;
        $secret = Secret::find(1);
        $Mt0 = !$secret;
        if ($Mt0) goto MtBodyxg;
        goto MtNextxg;
        MtBodyxg:
        return "请先配置密钥";
        goto Mtxf;
        MtNextxg:
        $data['appKey'] = $secret->key;
        $data['appSecret'] = $secret->secret;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $data = curl_exec($ch);
        if (curl_errno($ch)) goto MtBodyxi;
        goto MtNextxi;
        MtBodyxi:
        return curl_error($ch);
        goto Mtxh;
        MtNextxi:Mtxh:
        curl_close($ch);
        return json_encode($data);
        Mtxf:
    }

    public function edit($id)
    {
        $u = 'api/v4/apply';
        $MtAC0 = array();
        $MtAC0['id'] = $id;
        $conditions = $MtAC0;
        $MtAC1 = array();
        $MtAC1[] =& $u;
        $MtAC1[] =& $conditions;
        $MtAC2 = array();
        $MtAC2[] = $this;
        $MtAC2[] = "applyCurl";
        $MtAC0 = call_user_func_array($MtAC2, $MtAC1);
        $result = $MtAC0;
        $result = json_decode(json_decode($result));
        $MtAC0 = array();
        $data = $MtAC0;
        $Mt0 = $result->code == 0;
        if ($Mt0) goto MtBodyxk;
        goto MtNextxk;
        MtBodyxk:
        $data = $result->data[0];
        goto Mtxj;
        MtNextxk:Mtxj:
        return view('admin.apply.apply_edit', compact('data'));
    }

    public function editTemplate(Request $request, $id)
    {
        $tag = $request->tag;
        $u = 'api/v4/template';
        $MtAC0 = array();
        $MtAC0['id'] = $id;
        $conditions = $MtAC0;
        $MtAC1 = array();
        $MtAC1[] =& $u;
        $MtAC1[] =& $conditions;
        $MtAC2 = array();
        $MtAC2[] = $this;
        $MtAC2[] = "applyCurl";
        $MtAC0 = call_user_func_array($MtAC2, $MtAC1);
        $result = $MtAC0;
        $result = json_decode(json_decode($result));
        $MtAC0 = array();
        $data = $MtAC0;
        $Mt0 = $result->code == 0;
        if ($Mt0) goto MtBodyxm;
        goto MtNextxm;
        MtBodyxm:
        $data = $result->data[0];
        goto Mtxl;
        MtNextxm:Mtxl:
        $info = MyTemplate::where('tag', $tag)->first();
        return view('admin.apply.template_edit', compact('data', 'info'));
    }

    public function editPart($id)
    {
        $u = 'api/v4/part';
        $MtAC0 = array();
        $MtAC0['id'] = $id;
        $conditions = $MtAC0;
        $MtAC1 = array();
        $MtAC1[] =& $u;
        $MtAC1[] =& $conditions;
        $MtAC2 = array();
        $MtAC2[] = $this;
        $MtAC2[] = "applyCurl";
        $MtAC0 = call_user_func_array($MtAC2, $MtAC1);
        $result = $MtAC0;
        $result = json_decode(json_decode($result));
        $MtAC0 = array();
        $data = $MtAC0;
        $Mt0 = $result->code == 0;
        if ($Mt0) goto MtBodyxo;
        goto MtNextxo;
        MtBodyxo:
        $data = $result->data[0];
        goto Mtxn;
        MtNextxo:Mtxn:
        return view('admin.apply.part_edit', compact('data'));
    }

    public function applyUpdate(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        $Mt0 = $type == 'apply';
        if ($Mt0) goto MtBodyxq;
        goto MtNextxq;
        MtBodyxq:
        $u = 'api/v4/apply';
        $info = MyApply::where('tag', $id)->first();
        goto Mtxp;
        MtNextxq:
        $Mt0 = $type == 'template';
        if ($Mt0) goto MtBodyxr;
        goto MtNextxr;
        MtBodyxr:
        $u = 'api/v4/template';
        $info = MyTemplate::where('tag', $id)->first();
        goto Mtxp;
        MtNextxr:
        $Mt0 = $type == 'part';
        if ($Mt0) goto MtBodyxs;
        goto MtNextxs;
        MtBodyxs:
        $u = 'api/v4/part';
        $info = MyPart::where('tag', $id)->first();
        goto Mtxp;
        MtNextxs:
        return response(['code' => 1, 'info' => '非法请求']);
        Mtxp:
        $Mt0 = !$info;
        if ($Mt0) goto MtBodyxu;
        goto MtNextxu;
        MtBodyxu:
        $MtAC1 = array();
        $MtAC1['tag'] = $id;
        $MtAC1['cate'] = 1;
        $MtAC2 = array();
        $MtAC2[] =& $u;
        $MtAC2[] =& $MtAC1;
        $MtAC3 = array();
        $MtAC3[] = $this;
        $MtAC3[] = "applyCurl";
        $MtAC0 = call_user_func_array($MtAC3, $MtAC2);
        $result = $MtAC0;
        $result = json_decode(json_decode($result));
        $Mt0 = $result->code == 0;
        if ($Mt0) goto MtBodyxw;
        goto MtNextxw;
        MtBodyxw:
        $online = $result->data[0];
        $data['version'] = $online->version;
        $data['slug'] = $type;
        $data['package'] = $online->package;
        $data['file'] = $online->file_url;
        $data['download'] = 0;
        $data['install'] = 0;
        $data['content'] = $online->mark;
        $Mt0 = public_path() . '/file/';
        $Mt1 = $Mt0 . $online->package;
        $data['local_path'] = $Mt1;
        $install_r = Version::create($data);
        if ($install_r) goto MtBodyxy;
        goto MtNextxy;
        MtBodyxy:
        $A__AA = "unlink";
        $MtAC0 = $A__AA(base_path() . '/bootstrap/cache/packages.php');
        $A_A__ = "unlink";
        $MtAC0 = $A_A__(base_path() . '/bootstrap/cache/services.php');
        $order = $this->renewal($online->file_url, $online->package);
        if ($order['file_name']) goto MtBodyx11;
        goto MtNextx11;
        MtBodyx11:
        $this->renewalInstall($install_r->id, $online->package);
        $A_A_A = "substr";
        $MtAC1 = $A_A_A($data['local_path'], 0, -4);
        $MtAC2 = array();
        $MtAC2[] =& $MtAC1;
        $MtAC3 = array();
        $MtAC3[] = $this;
        $MtAC3[] = "deldir";
        $MtAC0 = call_user_func_array($MtAC3, $MtAC2);
        unlink(public_path() . '/file/' . $online->package);
        $MtAC0 = array();
        $MtAC0['name'] = $online->name;
        $MtAC0['tag'] = $online->tag;
        $MtAC0['logo'] = $online->logo;
        $MtAC0['price'] = $online->price;
        $MtAC0['type'] = $online->type;
        $Mt0 = $online->type == 'free';
        if ($Mt0) goto MtBodyx13;
        goto MtNextx13;
        MtBodyx13:
        $Mt1 = '永久';
        goto Mtx12;
        MtNextx13:
        $Mt1 = '2029-12-31';
        Mtx12:
        $MtAC0['expire_at'] = $Mt1;
        $MtAC0['author'] = $online->author;
        $MtAC0['version'] = $online->version;
        $my_data = $MtAC0;
        $Mt0 = $type == 'apply';
        if ($Mt0) goto MtBodyx15;
        goto MtNextx15;
        MtBodyx15:
        exec('php /' . base_path() . '/artisan cache:clear');
        MyApply::create($my_data);
        goto Mtx14;
        MtNextx15:
        $Mt0 = $type == 'template';
        if ($Mt0) goto MtBodyx16;
        goto MtNextx16;
        MtBodyx16:
        $my_data['scope'] = $online->scope;
        MyTemplate::create($my_data);
        exec('php /' . base_path() . '/artisan cache:clear');
        goto Mtx14;
        MtNextx16:
        exec('php /' . base_path() . '/artisan cache:clear');
        MyPart::create($my_data);
        Mtx14:
        return response(['code' => 0, 'info' => '下载成功']);
        goto Mtxz;
        MtNextx11:
        return response(['code' => 1, 'info' => '下载失败请重新下载']);
        Mtxz:
        goto Mtxx;
        MtNextxy:Mtxx:
        goto Mtxv;
        MtNextxw:
        return response(['code' => 1, 'info' => '请求失败']);
        Mtxv:
        goto Mtxt;
        MtNextxu:
        return response(['code' => 1, 'info' => '已下载此应用']);
        Mtxt:
    }
}

?>