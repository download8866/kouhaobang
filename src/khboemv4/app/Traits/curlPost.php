<?php
/*
 �������� �ںŰ� ����
 ����ʱ�� 2020-03-01 19:44:33
 ����֧�� �ںŰ� 
 �Ͻ������롢������κ���ʽ����Ȩ��Ϊ��Υ�߽�׷����������
*/

namespace App\Traits;trait curlPost{function requestPost_($url,$post_data=null){$ch=curl_init();curl_setopt($ch,CURLOPT_URL,$url);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch,CURLOPT_POST,1);curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);$output=curl_exec($ch);curl_close($ch);return $output;}}
?>