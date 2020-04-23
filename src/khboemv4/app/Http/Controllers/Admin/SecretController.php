<?php

namespace App\Http\Controllers\Admin;

use App\Models\Secret;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SecretController extends Controller
{
    public  function  index()
    {
        $info = Secret::find(1);
        if($info)
        {
            $app_key =$info->key ;
            $app_secret =$info->secret;
        }else{
            $app_key ='';
            $app_secret ='';
        }
        return  view('admin.secret.index',compact('app_key','app_secret'));
    }



    public  function   update(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'app_key'=>'required',
            'app_secret'=>'required',
        ]);
        if(!$validate->fails()){
            $info = Secret::find(1);
            if($info)
            {
                $info->key = $request->get('app_key');
                $info->secret = $request->get('app_secret');
                $info->save();
            }else{
                Secret::create(['key'=>$request->get('app_key'),'secret'=>$request->get('app_secret')]);
            }
            return response()->json(['code'=>200,'msg'=>'配置成功','data'=>null]);
        }else if($validate->errors()->has('app_key')){
            return response()->json(['code'=>0,'msg'=>'请输入App_key','data'=>null]);
        }else if($validate->errors()->has('app_secret')){
            return response()->json(['code'=>0,'msg'=>'请输入App_secret','data'=>null]);
        }
    }
}
