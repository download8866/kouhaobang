<?php

namespace App\Http\Controllers\Admin;

use App\Models\SmsSetting;
use App\Traits\Sms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SmsController extends Controller
{
    use Sms;
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $sms = SmsSetting::get();
        return view('admin.sms.index',compact('sms'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function edit($id){
        $info = SmsSetting::find($id);
        return view('admin.sms.edit',compact('id','info'));
    }


    /**
     * 支付配置
     */
    public function data(){
        $res = SmsSetting::paginate(10)->toArray();
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id){
        $data = $request->except('_token');
        $exist = SmsSetting::find($id);
        if($exist){
            SmsSetting::where(['id'=>$id])->update($data);
            return redirect()->route('admin.sysmsg');
        }else{
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * 配置保存
     */
    public function store(Request $request){
        $data = $request->except('_token');
        $data['sms_title'] = '【'.$data['signature'].'】';
        $data['resource'] = 'zst';
        $res = $this->register($data);
        if($res['code'] == 200){
            SmsSetting::create(['phone'=>$data['phone'],'password'=>$data['password'],'signature'=>$data['signature'],'appkey'=>$res['data']['AppKey'],'appsecret'=>$res['data']['AppSecret'],'name'=>$data['name']]);
            return redirect()->route('admin.sysmsg');
        }else{
            return redirect()->to(route('admin.sysmsg.create'))->withErrors($res['info']);
        }
    }

    /**
     * 短信配置
     */
    public function create(){
        return view('admin.sms.create');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 短信充值记录
     */
    public function rechargeData(){
        $info = SmsSetting::first();
        if($info)
        {
            $data = ['sms_key' => $info->appkey, 'sms_secret' => $info->appsecret];
            $charge = $this->getRechargeList($data);
            $res = $charge['data'];
            $data = [
                'code' => 0,
                'msg'   => '正在请求中...',
                'count' => $res['total'],
                'data'  => $res['data']
            ];
        }else{
            $data = [
                'code' => 500,
                'msg'   => '请先配置账户',
                'count' => 0,
                'data'  => 0
            ];
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recharge(){
        $info = SmsSetting::first();
        if($info){
            $data = ['sms_key' => $info->appkey, 'sms_secret' => $info->appsecret];
            $charge = $this->getRestList($data);
            $res = $charge['data'];
            $number = $res['number'];
        }else{
            $number = 0;
        }
        return view('admin.sms.recharge',compact('number'));
    }
    /**
     * 充值
     */
    public function charge(){
        $account = SmsSetting::first();
        $show = '';
        if(count($account)){
            return view('admin.sms.charge',compact('show'));
        }else{
            abort(404,'你还没有配置账户，请先申请！');
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 短信模板
     */
    public function getTemplate(){
        $template = Session::get('template');
        if(!$template) {
            $url = $this->postUrl . 'api/sms/template';
            $template = $this->requestGet($url);
            Session::put('template',$template);
            Session::save();
        }
        return view('admin.sms.template',compact('template'));
    }

    /**
     * 最新版本号
     */
    public function getVersion(){
        $url = $this->postUrl . 'api/sys/version';
        $version = $this->requestGet($url);
        return  $version;
    }

}
