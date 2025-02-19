<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:44:33
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Traits;

use App\Models\Secret;
use Yansongda\Pay\Log;

trait Sms
{
    public $postUrl = "http://sms.kouhaobang.com/";
    public $cloudUrl = "http://api.kouhaobang.com/";

    function requestPost($url, $post_data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output, true);
    }

    function requestGet($url)
    {
        $A____A_A = "file_get_contents";
        $EpAC0 = $A____A_A($url);
        $content = $EpAC0;
        return json_decode($content, true);
    }

    public function getRechargeList($data)
    {
        $Ep0 = config('yun.sms') . '/api/get/charge/list';
        $url = $Ep0;
        $EpAC1 = array();
        $EpAC1[] =& $url;
        $EpAC1[] =& $data;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "requestPost";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        $res = $EpAC0;
        return $res;
    }

    public function getRestList($data)
    {
        $Ep0 = config('yun.sms') . '/api/get/number/rest';
        $url = $Ep0;
        $EpAC1 = array();
        $EpAC1[] =& $url;
        $EpAC1[] =& $data;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "requestPost";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        $res = $EpAC0;
        return $res;
    }

    public function register($data)
    {
        $Ep0 = config('yun.sms') . '/api/register';
        $url = $Ep0;
        $EpAC1 = array();
        $EpAC1[] =& $url;
        $EpAC1[] =& $data;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "requestPost";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        $res = $EpAC0;
        return $res;
    }

    public function getVersion()
    {
        $Ep0 = config('yun.sms') . '/api/sys/version';
        $version = $Ep0;
        return $version;
    }

    public function syncDictionary($type)
    {
        $Ep0 = config('yun.dictionary') . '/api/v4/sync/dictionary';
        $url = $Ep0;
        $secret = Secret::find(1);
        $type['appKey'] = $secret->key;
        $type['appSecret'] = $secret->secret;
        $EpAC1 = array();
        $EpAC1[] =& $url;
        $EpAC1[] =& $type;
        $EpAC2 = array();
        $EpAC2[] = $this;
        $EpAC2[] = "requestPost";
        $EpAC0 = call_user_func_array($EpAC2, $EpAC1);
        return $EpAC0;
    }

    public function cloudCurl($u, $data)
    {
        $Ep0 = config('yun.dictionary') . $u;
        $url = $Ep0;
        $secret = Secret::find(1);
        $data['appKey'] = $secret->key;
        $data['appSecret'] = $secret->secret;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $data = curl_exec($ch);
        if (curl_errno($ch)) goto EpBodyx2;
        goto EpNextx2;
        EpBodyx2:
        return curl_error($ch);
        goto Epx1;
        EpNextx2:Epx1:
        curl_close($ch);
        return json_encode($data);
    }
}

?>