<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 20:24:55
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Models\Member;
use App\Models\MyPart;
use App\Models\Page;
use App\Models\SmsRecord;
use App\Models\SmsSetting;
use App\Traits\Msg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use Msg;

    public function login()
    {
        if (auth('member')->user()) goto PsBodyx2;
        goto PsNextx2;
        PsBodyx2:
        return redirect('/member');
        goto Psx1;
        PsNextx2:
        $image = Advert::where('id', '3')->first();
        $image->thumbs = explode(',', $image->thumb);
        $sms_status = MyPart::where(['tag' => 'cr_sms', 'status' => 1])->first();
        $sms_app = SmsSetting::find(1);
        $Ps0 = (bool)$sms_status;
        if ($Ps0) goto PsBodyx5;
        goto PsNextx5;
        PsBodyx5:
        $Ps0 = (bool)$sms_app;
        goto Psx4;
        PsNextx5:Psx4:
        if ($Ps0) goto PsBodyx6;
        goto PsNextx6;
        PsBodyx6:
        $sms_status = 1;
        goto Psx3;
        PsNextx6:
        $sms_status = 0;
        Psx3:
        return view('home.login', compact('image', 'sms_status'));
        Psx1:
    }

    public function register()
    {
        $image = Advert::where('id', '2')->first();
        $image->thumbs = explode(',', $image->thumb);
        $sms_status = MyPart::where(['tag' => 'cr_sms', 'status' => 1])->first();
        $sms_app = SmsSetting::find(1);
        $Ps0 = (bool)$sms_status;
        if ($Ps0) goto PsBodyx9;
        goto PsNextx9;
        PsBodyx9:
        $Ps0 = (bool)$sms_app;
        goto Psx8;
        PsNextx9:Psx8:
        if ($Ps0) goto PsBodyxa;
        goto PsNextxa;
        PsBodyxa:
        $sms_status = 1;
        goto Psx7;
        PsNextxa:
        $sms_status = 0;
        Psx7:
        return view('home.register', compact('sms_status', 'image'));
    }

    public function forgot()
    {
        return view('home.forgot');
    }

    public function loginCheck(Request $request)
    {
        $validate = Validator::make($request->all(), ['username' => 'required', 'password' => 'required']);
        $PsAC1 = array();
        $PsAC2 = array();
        $PsAC2[] = $validate;
        $PsAC2[] = "fails";
        $PsAC0 = call_user_func_array($PsAC2, $PsAC1);
        $Ps0 = !$PsAC0;
        if ($Ps0) goto PsBodyxc;
        goto PsNextxc;
        PsBodyxc:
        $exist = Member::where(['name' => $request->username])->first();
        $AA_A_AA = "count";
        $PsAC0 = $AA_A_AA($exist);
        if ($PsAC0) goto PsBodyxe;
        goto PsNextxe;
        PsBodyxe:
        $Ps0 = $exist->status == 1;
        if ($Ps0) goto PsBodyxg;
        goto PsNextxg;
        PsBodyxg:
        if (Auth::guard('member')->attempt(['name' => $request->username, 'password' => $request->password])) goto PsBodyxi;
        goto PsNextxi;
        PsBodyxi:
        return response()->json(['code' => 0, 'info' => '登录成功']);
        goto Psxh;
        PsNextxi:
        return response()->json(['code' => 1, 'info' => '密码不正确']);
        Psxh:
        goto Psxf;
        PsNextxg:
        return response()->json(['code' => 1, 'info' => '该账户被限制登录']);
        Psxf:
        goto Psxd;
        PsNextxe:
        return response()->json(['code' => 1, 'info' => '该用户名不存在']);
        Psxd:
        goto Psxb;
        PsNextxc:
        return response()->json(['code' => 1, 'info' => '参数不正确']);
        Psxb:
    }

    public function phoneLogin(Request $request)
    {
        $validate = Validator::make($request->all(), ['phone' => 'required',]);
        $PsAC1 = array();
        $PsAC2 = array();
        $PsAC2[] = $validate;
        $PsAC2[] = "fails";
        $PsAC0 = call_user_func_array($PsAC2, $PsAC1);
        $Ps0 = !$PsAC0;
        if ($Ps0) goto PsBodyxk;
        goto PsNextxk;
        PsBodyxk:
        $exist = Member::where(['phone' => $request->phone])->first();
        $AA_AA__ = "count";
        $PsAC0 = $AA_AA__($exist);
        if ($PsAC0) goto PsBodyxm;
        goto PsNextxm;
        PsBodyxm:
        $Ps0 = $exist->status == 1;
        if ($Ps0) goto PsBodyxo;
        goto PsNextxo;
        PsBodyxo:
        $sms_info = $this->checkPhoneCode($request->phone, 'login');
        $AA_AA_A = "explode";
        $PsAC0 = $AA_AA_A(',', $sms_info);
        $sms = $PsAC0;
        $AA_AAA_ = "time";
        $PsAC0 = $AA_AAA_();
        $Ps0 = $sms[1] < $PsAC0;
        if ($Ps0) goto PsBodyxq;
        goto PsNextxq;
        PsBodyxq:
        $Ps0 = $sms[0] == $request->code;
        if ($Ps0) goto PsBodyxs;
        goto PsNextxs;
        PsBodyxs:
        auth('member')->loginUsingId($exist->id);
        return response()->json(['code' => 0, 'info' => '登录成功']);
        goto Psxr;
        PsNextxs:
        return response()->json(['code' => 1, 'info' => '验证码不正确']);
        Psxr:
        goto Psxp;
        PsNextxq:
        return response()->json(['code' => 1, 'info' => '验证码已过期']);
        Psxp:
        goto Psxn;
        PsNextxo:
        return response()->json(['code' => 1, 'info' => '该账户被限制登录']);
        Psxn:
        goto Psxl;
        PsNextxm:
        return response()->json(['code' => 1, 'info' => '该号码不存在']);
        Psxl:
        goto Psxj;
        PsNextxk:
        return response()->json(['code' => 1, 'info' => '参数不正确']);
        Psxj:
    }

    public function verify(Request $request)
    {
        $sms_status = MyPart::where(['tag' => 'cr_sms', 'status' => 1])->first();
        $Ps1 = (bool)$sms_status;
        if ($Ps1) goto PsBodyxv;
        goto PsNextxv;
        PsBodyxv:
        $Ps0 = $sms_status->status == 1;
        $Ps1 = (bool)$Ps0;
        goto Psxu;
        PsNextxv:Psxu:
        if ($Ps1) goto PsBodyxw;
        goto PsNextxw;
        PsBodyxw:
        $type = $request->type;
        $phone = $request->phone;
        $Ps0 = $type == 'register';
        if ($Ps0) goto PsBodyxy;
        goto PsNextxy;
        PsBodyxy:
        $member = Member::where('phone', $phone)->first();
        goto Psxx;
        PsNextxy:
        $member = false;
        Psxx:
        $Ps0 = !$member;
        if ($Ps0) goto PsBodyx11;
        goto PsNextx11;
        PsBodyx11:
        $AA_AAAA = "mt_rand";
        $PsAC0 = $AA_AAAA(1001, 9999);
        $code = $PsAC0;
        $PsAC1 = array();
        $PsAC1[] =& $phone;
        $PsAC1[] =& $type;
        $PsAC2 = array();
        $PsAC2[] = $this;
        $PsAC2[] = "checkCodeHistory";
        $PsAC0 = call_user_func_array($PsAC2, $PsAC1);
        $result = $PsAC0;
        $Ps0 = $result == 1;
        if ($Ps0) goto PsBodyx13;
        goto PsNextx13;
        PsBodyx13:
        $res = json_decode($this->sendContent($phone, $code, $type));
        $Ps0 = $res->code == '200';
        if ($Ps0) goto PsBodyx15;
        goto PsNextx15;
        PsBodyx15:
        $PsAC1 = array();
        $PsAC1[] =& $phone;
        $PsAC1[] =& $code;
        $PsAC1[] =& $type;
        $PsAC2 = array();
        $PsAC2[] = $this;
        $PsAC2[] = "setCodeRedis";
        $PsAC0 = call_user_func_array($PsAC2, $PsAC1);
        SmsRecord::create(['phone' => $phone, 'code' => $code, 'content' => "获取验证码成功",]);
        return response()->json(['code' => 0, 'info' => '发送成功']);
        goto Psx14;
        PsNextx15:
        return response()->json(['code' => 1, 'info' => '发送失败']);
        Psx14:
        goto Psx12;
        PsNextx13:
        $Ps0 = $result == 0;
        if ($Ps0) goto PsBodyx16;
        goto PsNextx16;
        PsBodyx16:
        return response()->json(['code' => 1, 'info' => '短信条数已到上限']);
        goto Psx12;
        PsNextx16:
        return response()->json(['code' => 1, 'info' => '发送失败']);
        Psx12:
        goto Psxz;
        PsNextx11:
        return response()->json(['code' => 1, 'info' => '手机号码已注册']);
        Psxz:
        goto Psxt;
        PsNextxw:
        return response()->json(['code' => 1, 'info' => '未启用短信']);
        Psxt:
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), ['phone' => 'required|min:11|max:11|regex:/^1[3456789]\d{9}$/', 'password' => 'required', 'username' => 'required',]);
        $PsAC1 = array();
        $PsAC2 = array();
        $PsAC2[] = $validate;
        $PsAC2[] = "fails";
        $PsAC0 = call_user_func_array($PsAC2, $PsAC1);
        $Ps0 = !$PsAC0;
        if ($Ps0) goto PsBodyx18;
        goto PsNextx18;
        PsBodyx18:
        $sms_status = MyPart::where(['tag' => 'cr_sms', 'status' => 1])->first();
        $sms_app = SmsSetting::find(1);
        $msg = '';
        $Ps0 = (bool)$sms_app;
        if ($Ps0) goto PsBodyx1d;
        goto PsNextx1d;
        PsBodyx1d:
        $Ps0 = (bool)$sms_status;
        goto Psx1c;
        PsNextx1d:Psx1c:
        $Ps2 = (bool)$Ps0;
        if ($Ps2) goto PsBodyx1b;
        goto PsNextx1b;
        PsBodyx1b:
        $Ps1 = $sms_status->status == 1;
        $Ps2 = (bool)$Ps1;
        goto Psx1a;
        PsNextx1b:Psx1a:
        if ($Ps2) goto PsBodyx1e;
        goto PsNextx1e;
        PsBodyx1e:
        $sms_info = $this->checkPhoneCode($request->phone, 'register');
        if ($sms_info) goto PsBodyx1g;
        goto PsNextx1g;
        PsBodyx1g:
        $AAA____ = "explode";
        $PsAC0 = $AAA____(',', $sms_info);
        $sms = $PsAC0;
        $AAA___A = "time";
        $PsAC0 = $AAA___A();
        $Ps0 = $sms[1] < $PsAC0;
        if ($Ps0) goto PsBodyx1i;
        goto PsNextx1i;
        PsBodyx1i:
        $Ps0 = $sms[0] == $request->code;
        if ($Ps0) goto PsBodyx1k;
        goto PsNextx1k;
        PsBodyx1k:
        $verify = 1;
        goto Psx1j;
        PsNextx1k:
        $msg = "验证码不正确";
        $verify = 0;
        Psx1j:
        goto Psx1h;
        PsNextx1i:
        $msg = "验证码已过期";
        $verify = 0;
        Psx1h:
        goto Psx1f;
        PsNextx1g:
        $msg = "验证码不正确";
        $verify = 0;
        Psx1f:
        goto Psx19;
        PsNextx1e:
        $PsAC0 = array();
        $PsAC0['captcha'] = 'required|captcha';
        $rules = $PsAC0;
        $validator = Validator::make($request->all(), $rules);
        $PsAC1 = array();
        $PsAC2 = array();
        $PsAC2[] = $validator;
        $PsAC2[] = "fails";
        $PsAC0 = call_user_func_array($PsAC2, $PsAC1);
        if ($PsAC0) goto PsBodyx1m;
        goto PsNextx1m;
        PsBodyx1m:
        $msg = "验证码不正确";
        $verify = 0;
        goto Psx1l;
        PsNextx1m:
        $verify = 1;
        Psx1l:Psx19:
        if ($verify) goto PsBodyx1o;
        goto PsNextx1o;
        PsBodyx1o:
        $exist = Member::where(['phone' => $request->phone])->first();
        $Ps0 = !$exist;
        if ($Ps0) goto PsBodyx1q;
        goto PsNextx1q;
        PsBodyx1q:
        $member = Member::create(['phone' => $request->phone, 'password' => password_hash($request->password, PASSWORD_DEFAULT), 'name' => $request->username, 'register_ip' => $request->getClientIp(), 'last_login_ip' => $request->getClientIp(), 'last_login_time' => date('Y-m-d H:i:s'), 'remember_token' => '', 'status' => 1,]);
        Auth::guard('member')->loginUsingId($member->id);
        return response()->json(['code' => 0, 'info' => '注册成功']);
        goto Psx1p;
        PsNextx1q:
        return response()->json(['code' => 1, 'info' => '该手机号码已注册']);
        Psx1p:
        goto Psx1n;
        PsNextx1o:
        return response()->json(['code' => 1, 'info' => $msg]);
        Psx1n:
        goto Psx17;
        PsNextx18:
        return response()->json(['code' => 1, 'info' => '参数错误']);
        Psx17:
    }

    public function resetPass(Request $request)
    {
        $validate = Validator::make($request->all(), ['phone' => 'required', 'password' => 'required',]);
        $PsAC1 = array();
        $PsAC2 = array();
        $PsAC2[] = $validate;
        $PsAC2[] = "fails";
        $PsAC0 = call_user_func_array($PsAC2, $PsAC1);
        $Ps0 = !$PsAC0;
        if ($Ps0) goto PsBodyx1s;
        goto PsNextx1s;
        PsBodyx1s:
        $sms_status = SmsSetting::find(1);
        $msg = '';
        $Ps1 = (bool)$sms_status;
        if ($Ps1) goto PsBodyx1v;
        goto PsNextx1v;
        PsBodyx1v:
        $Ps0 = $sms_status->status == 1;
        $Ps1 = (bool)$Ps0;
        goto Psx1u;
        PsNextx1v:Psx1u:
        if ($Ps1) goto PsBodyx1w;
        goto PsNextx1w;
        PsBodyx1w:
        $sms_info = $this->checkPhoneCode($request->phone, $request->type);
        if ($sms_info) goto PsBodyx1y;
        goto PsNextx1y;
        PsBodyx1y:
        $AAA__A_ = "explode";
        $PsAC0 = $AAA__A_(',', json_decode($sms_info));
        $sms = $PsAC0;
        $AAA__AA = "time";
        $PsAC0 = $AAA__AA();
        $Ps0 = $sms[1] > $PsAC0;
        if ($Ps0) goto PsBodyx21;
        goto PsNextx21;
        PsBodyx21:
        $Ps0 = $sms[0] == $request->code;
        if ($Ps0) goto PsBodyx23;
        goto PsNextx23;
        PsBodyx23:
        $verify = 1;
        goto Psx22;
        PsNextx23:
        $msg = "验证码不正确";
        $verify = 0;
        Psx22:
        goto Psx2z;
        PsNextx21:
        $msg = "验证码已过期";
        $verify = 0;
        Psx2z:
        goto Psx1x;
        PsNextx1y:
        $msg = "验证码不正确";
        $verify = 0;
        Psx1x:
        goto Psx1t;
        PsNextx1w:
        $PsAC0 = array();
        $PsAC0['captcha'] = 'required|captcha';
        $rules = $PsAC0;
        $validator = Validator::make($request->all(), $rules);
        $PsAC1 = array();
        $PsAC2 = array();
        $PsAC2[] = $validator;
        $PsAC2[] = "fails";
        $PsAC0 = call_user_func_array($PsAC2, $PsAC1);
        if ($PsAC0) goto PsBodyx25;
        goto PsNextx25;
        PsBodyx25:
        $msg = "验证码不正确";
        $verify = 0;
        goto Psx24;
        PsNextx25:
        $verify = 1;
        Psx24:Psx1t:
        if ($verify) goto PsBodyx27;
        goto PsNextx27;
        PsBodyx27:
        $exist = Member::where(['phone' => $request->phone, 'type' => 1])->first();
        if ($exist) goto PsBodyx29;
        goto PsNextx29;
        PsBodyx29:
        $exist->password = bcrypt($request->password);
        $PsAC1 = array();
        $PsAC2 = array();
        $PsAC2[] = $exist;
        $PsAC2[] = "save";
        $PsAC0 = call_user_func_array($PsAC2, $PsAC1);
        return response()->json(['code' => 0, 'info' => '修改成功']);
        goto Psx28;
        PsNextx29:
        return response()->json(['code' => 1, 'info' => '账户不存在']);
        Psx28:
        goto Psx26;
        PsNextx27:
        return response()->json(['code' => 1, 'info' => $msg]);
        Psx26:
        goto Psx1r;
        PsNextx1s:
        return response()->json(['code' => 1, 'info' => '参数不正确']);
        Psx1r:
    }

    public function logout()
    {
        Auth::guard('members')->logout();
        return redirect('/index');
    }

    public function serverClause()
    {
        $contact = Page::where('tag', 'privacy')->first();
        return response()->json(['code' => 0, 'data' => $contact]);
    }

    public function serverRegister()
    {
        $contact = Page::where('tag', 'register')->first();
        return response()->json(['code' => 0, 'data' => $contact]);
    }
}

?>