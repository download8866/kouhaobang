<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:44:33
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Traits;

use App\Models\SmsRecord;
use App\Models\SmsSetting;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

trait Msg
{
    protected $messageCount = 10;
    protected $encode = 'UTF-8';
    protected $accesskey = '';
    protected $secret = '';
    protected $msg_url = "http://sms.kouhaobang.com/api/send/do";

    function requestPostNew($url, $post_data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function setCodeRedis($phone, $code, $verifyType)
    {
        Session::forget('sms_' . $verifyType . '_' . $phone);
        Session(['sms_' . $verifyType . '_' . $phone => $code . ',' . time()]);
        Session::save();
    }

    public function destroyCodeRedis($phone, $verifyType)
    {
        Session::forget('sms_' . $verifyType . '_' . $phone);
    }

    public function checkCodeHistory($phone, $type)
    {
        $number = SmsRecord::where('phone', $phone)->where('created_at', '>=', date('Y-m-d'))->count();
        $Ep0 = $number < $this->messageCount;
        if ($Ep0) goto EpBodyx2;
        goto EpNextx2;
        EpBodyx2:
        return 1;
        goto Epx1;
        EpNextx2:
        return 0;
        Epx1:
    }

    public function checkPhoneCode($phone, $verifyType)
    {
        if (Session::get('sms_' . $verifyType . '_' . $phone)) goto EpBodyx4;
        goto EpNextx4;
        EpBodyx4:
        return Session::get('sms_' . $verifyType . '_' . $phone);
        goto Epx3;
        EpNextx4:
        return 0;
        Epx3:
    }

    public function sendContent($phone, $content, $type)
    {
        $setting = SmsSetting::first();
        $this->accesskey = $setting->appkey;
        $this->secret = $setting->appsecret;
        $EpAC0 = array();
        $EpAC0['sms_key'] = $this->accesskey;
        $EpAC0['sms_secret'] = $this->secret;
        $EpAC0['phone'] = $phone;
        $EpAC0['code'] = $content;
        $EpAC0['category'] = $type;
        $param = $EpAC0;
        $res = $this->requestPostNew($this->msg_url, $param);
        return $res;
    }
}

?>