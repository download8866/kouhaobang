<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:44:33
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Traits;

use GuzzleHttp\Client;

trait PushMessage
{
    public function push($data)
    {
        $Ep0 = new Client();
        $client = $Ep0;
        $EpAC2 = array();
        $EpAC3 = array();
        $EpAC3['type'] = 'publish';
        $EpAC3['to'] = $data['accept_uuid'];
        $EpAC3['title'] = $data['title'];
        $EpAC3['content'] = $data['content'];
        $EpAC2['query'] = $EpAC3;
        $EpAC4 = array();
        $EpAC4[] = config('custom.PUSH_MESSAGE_URL');
        $EpAC4[] =& $EpAC2;
        $EpAC6 = array();
        $EpAC6[] = $client;
        $EpAC6[] = "get";
        $EpAC0 = call_user_func_array($EpAC6, $EpAC4);
        $message = \App\Models\Message::create(['title' => $data['title'], 'content' => $data['content'], 'send_uuid' => $data['send_uuid'], 'accept_uuid' => $data['accept_uuid'], 'flag' => $data['flag']]);
        return $message;
    }
}

?>