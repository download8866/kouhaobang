<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19
 * Time: 22:41
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\PaySetting;
use App\Models\Website;
use Illuminate\Http\Request;

class PayController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('admin.pay.index');
    }


    /**
     * 支付配置
     */
    public function data(){
        $res = PaySetting::paginate(10)->toArray();
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res['total'],
            'data'  => $res['data']
        ];
        return response()->json($data);
    }

    /**
     * @param $id
     * 编辑
     */
    public function edit($id){
        $info = PaySetting::find($id);
        if($info->type == 'alipay'){
            $appid = config('pay.alipay.app_id');
            $ali_public_key = config('pay.alipay.ali_public_key');
            $private_key = config('pay.alipay.private_key');
            return view('admin.pay.alipay',compact('info','private_key','appid','ali_public_key'));
        }else{
            return view('admin.pay.qrcode',compact('info'));
        }
    }

    /**
     * @param Request $request
     * 保存
     */
    public function update(Request $request,$id)
    {
        $info = PaySetting::find($id);
        if ($info->type == 'alipay') {

            $appid = $request->app_id;
            $notify_url = $request->notify_url;
            $return_url = $request->return_url;
            $ali_public_key = $request->ali_public_key;
            $private_key = $request->private_key;
            $html = <<<HTML
<?php
return [
    'alipay' => [
        /*支付宝分配的 APPID*/
        'app_id' => '$appid',

        /* 支付宝异步通知地址*/
        'notify_url' => '$notify_url',

        /* 支付成功后同步通知地址*/
        'return_url' => '$return_url',

        /* 阿里公共密钥，验证签名时使用*/
        'ali_public_key' => '$ali_public_key',

        /* 自己的私钥，签名时使用*/
        'private_key' => '$private_key',

        /* optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'*/
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],
    'wechat' => [
        // 公众号 APPID
        'app_id' => '',

        // 小程序 APPID
        'miniapp_id' => '',

        // APP 引用的 appid
        'appid' => '',

        // 微信支付分配的微信商户号
        'mch_id' => '',

        // 微信支付异步通知地址
        'notify_url' => '/notify',

        // 微信支付签名秘钥
        'key' => '',

        // 客户端证书路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_client' => '',

        // 客户端秘钥路径，退款、红包等需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_key' => '',

        // optional，默认 warning；日志路径为：sys_get_temp_dir().'/logs/yansongda.pay.log'
        'log' => [
            'file' => storage_path('logs/wechat.log'),
        //     'level' => 'debug'
        ],   
    ],
];

?>
HTML;
            file_put_contents(dirname(dirname(dirname(dirname(__DIR__)))) . '/config/pay.php', $html);
            $data['status'] = $request->status == 'on' ? 1 : 0;
            if($data['status'] == 1)
            {
                PaySetting::where(['id' => $id])->update($data);
                PaySetting::where('id','!=',$id)->update(['status'=>0]);
            }else{
                PaySetting::where(['id' => $id])->update($data);
                PaySetting::where('id','!=',$id)->update(['status'=>1]);
            }
            return redirect()->route('admin.pay');
        } else {
            //扫码支付
            $data['status'] = $request->status == 'on' ? 1 : 0;
            $data['alipay_qrcode'] = $request->qrcode_alipay;
            $data['weixin_qrcode'] = $request->qrcode_weixin;
            if($data['status'] == 1)
            {
                PaySetting::where(['id' => $id])->update($data);
                PaySetting::where('id','!=',$id)->update(['status'=>0]);
            }else{
                PaySetting::where(['id' => $id])->update($data);
                PaySetting::where('id','!=',$id)->update(['status'=>1]);
            }
            return redirect()->route('admin.pay');
        }
    }
}