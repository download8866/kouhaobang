@extends('admin.base')
@section('content')
    <style>
        .clear:after,.clear:before { content: ""; display: block; clear: both; }
        .grid-item{background:#fff;box-sizing:border-box; border: 1px solid #fff;}
        .media { padding: 20px 10px;}
        .media .media-body{ padding-left: 10px; box-sizing:border-box;}
        .media .media-heading a { color:#000; }
        .jian {border-color:#14c7c0; background: url('/images/jian.png');  background-repeat: no-repeat;  background-color: #fff; background-position: -5px -5px; background-size: 45px 45px; }
        .media .media-heading {  margin-top: 5px; margin-bottom: 0px; font-size: 14px; font-weight: bold;  padding-top: 3px; height: 18px; overflow: hidden;}
        .media .media-body p { margin: 10px 0; color: #999;font-size: 12px;height: 35px;overflow: hidden;}
        .price {color:#ef4c2f;padding-top:10px; text-align: center;}
        .opt {text-align: center; padding-top:10px;}
        .app-left { padding-top:10px; width: 25%;float: left;}
        .app-left .media-object { border-radius: 15px; width: 80%;display: block; max-width: 100%;height: auto;margin-left: auto;margin-right: auto;}
        .media-heading .gf {padding: 1px 2px !important;font-size: 10px !important;line-height: 1.0 !important; color: #fff  !important;background-color: #2C99FF;border-color: #2C99FF;margin-top: -2px;margin-right: 5px;}
        .app-right { float: right; width: 75%;}
        .cpt .btn-xs {padding: 3px 10px;color: #FFF;border-radius: 3px;line-height: 1.44;font-size:12px;}
        .btn.red {background-color: #e7505a;border-color: #e7505a;}
        .btn.blue{background-color: #3598dc; border-color: #3598dc;}
    </style>
    <div class="layui-row layui-col-space10">
        @if(count($data))
            @foreach($data as $item)
                <div class="layui-col-lg3 layui-col-md4 layui-col-xs6">
                    <div class="grid-item jian">
                        <div class="media clear">
                            <div class="pull-left app-left">
                                <a >
                                    <img class="media-object" src="{{$item->logo}}">
                                </a>
                                <div class="price" style="">¥{{$item->price}}</div>
                            </div>
                            <div class="media-body app-right">
                                <h4 class="media-heading">
                                    <span class="btn btn-danger gf btn-xs">官方</span> <a href="https://www.xunruicms.com/shop/app/423.html" target="_blank">{{$item->name}}</a>
                                </h4>
                                <p>{{$item->slogan}}</p>
                                <div class="cpt">
                                    @if($item->status == 0)
                                        <a href="javascript:dr_buy('{{$item->id}}', '1');" class="btn red btn-xs">安装</a>
                                    @else
                                        <a href="javascript:dr_buy('{{$item->id}}', '0');" class="btn red btn-xs">停用</a>
                                    @endif
                                        <span  class="btn blue btn-xs">联系作者 </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
@section('script')
    <script>

        function dr_buy(id,status){
            $.post("{{route('admin.my.apply.part.install')}}",{id:id,'status':status},function (res) {
                if(res.code===0){
                    layer.msg(res.info,{icon:1});
                    setTimeout(function () {
                        window.location.reload();
                    },1500);
                }else {
                    layer.msg(res.info,{icon:2});
                }
            }).error(function (data) {
                $.each(data.responseJSON.errors,function (key,value) {
                    layer.msg(value[0],{icon:2});
                    return false;
                })
            });
            //异步提交
            return false;
        }
    </script>
@endsection