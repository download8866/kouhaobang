<?php
/*
 本代码由 口号帮 创建
 创建时间 2020-03-01 19:44:33
 技术支持 口号帮 
 严禁反编译、逆向等任何形式的侵权行为，违者将追究法律责任
*/

namespace App\Traits;trait curlPost{function requestPost_($url,$post_data=null){$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$url);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch,CURLOPT_POST,1);curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);$output=curl_exec($ch);curl_close($ch);return $output;}}
?>