@extends('admin.base')

@section('content')
    <style>
        .line-clamp1 {overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;}
        .line-clamp2 {overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;}
        .clear:after,.clear:before { content: ""; display: block; clear: both; }
        .grid-item{background:#fff;box-sizing:border-box; border: 1px solid #fff;}
        .media { padding: 20px 10px;}
        .media .media-body{ padding-left: 10px; box-sizing:border-box;}
        .media .media-heading a { color:#000; font-size:18px;}
        .jian {border-color:#14c7c0; background: url('/images/jian.png');  background-repeat: no-repeat;  background-color: #fff; background-position: -5px -5px; background-size: 45px 45px; }
        .media .media-heading {margin-bottom: 0px; font-size: 14px; font-weight: bold; height: 24px;}
        .media .media-body p { margin: 10px 0; color: #999;font-size: 12px;height: 35px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;}
        .price {color:#ef4c2f;padding-top:10px; text-align: center;}
        .opt {text-align: center; padding-top:10px;}
        .app-left { width: 25%;float: left;}
        .app-left .media-object { border-radius: 15px; width: 80%;display: block; max-width: 100%;height: auto;margin-left: auto;margin-right: auto;}
        .media-heading .gf {padding: 1px 2px !important;font-size: 10px !important;line-height: 1.0 !important; color: #fff  !important;background-color: #2C99FF;border-color: #2C99FF;margin-top: -2px;margin-right: 5px;}
        .app-right { float: right; width: 75%;}
        .cpt .btn-xs {padding: 3px 10px;color: #FFF;border-radius: 3px;line-height: 1.44;font-size:12px;}
        .btn.red {background-color: #e7505a;border-color: #e7505a;}
        .btn.blue{background-color: #3598dc; border-color: #3598dc;}
        .btn.disBuy{background-color: #ccc; border-color: #fff;}
    </style>
    <div class="layui-row layui-col-space10">
        @if(count($data))
            @foreach($data as $item)
                <div class="layui-col-lg3 layui-col-md4 layui-col-xs6">
                    <div class="grid-item jian">
                        <div class="media clear">
                            <div class="pull-left app-left">
                                <a href="#" >
                                    <img class="media-object" src="{{$item->logo}}">
                                </a>
                                <div class="price" style="">¥{{$item->price}}</div>
                            </div>
                            <div class="media-body app-right">
                                <h4 class="media-heading line-clamp1">
                                    <span class="btn btn-danger gf btn-xs">官方</span> <a href="javascript:;">{{$item->name}}</a>
                                </h4>
                                <p class="line-clamp2">{{$item->slogan}}</p>
                                <div class="cpt">
                                    @if(!in_array($item->tag,$list))
                                        <a href="javascript:;" class="btn blue btn-xs detail" id="{{$item->id}}">购买</a>
                                    @else
                                        <a href="javascript:;" class="btn blue btn-xs disBuy">已下载</a>
                                    @endif
                                    {{--<a href="javascript:;" class="btn blue btn-xs">联系作者 </a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="layui-col-lg3 layui-col-md4 layui-col-xs6">
            <div class="grid-item">
                <div class="media clear">
                    <div class="pull-left app-left">
                        <a href="#" >
                            <img class="media-object" src="http://img3.kouhaobang.com/HgzY9HahDDxlkhYlTAXVT9OT76ZdEJTp54PxsQlr.png">
                        </a>
                        <div class="price" style="">¥0</div>
                    </div>
                    <div class="media-body app-right">
                        <h4 class="media-heading line-clamp1">
                            <span class="btn btn-danger gf btn-xs">官方</span><a href="javascript:;">口号帮自媒体应用</a>
                        </h4>
                        <p class="line-clamp2">口号帮自媒体资源</p>
                        <div class="cpt">
                            <a href="javascript:;" class="btn blue btn-xs disBuy">2020.03.09上线，敬请期待！</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-lg3 layui-col-md4 layui-col-xs6">
            <div class="grid-item">
                <div class="media clear">
                    <div class="pull-left app-left">
                        <a href="#" >
                            <img class="media-object" src="http://img3.kouhaobang.com/8ZGsfEYVYZTynmnE79yRswylRQkold9jw9ZledAT.png">
                        </a>
                        <div class="price" style="">¥0</div>
                    </div>
                    <div class="media-body app-right">
                        <h4 class="media-heading line-clamp1">
                            <span class="btn btn-danger gf btn-xs">官方</span><a href="javascript:;">口号帮抖音应用</a>
                        </h4>
                        <p class="line-clamp2">口号帮抖音资源</p>
                        <div class="cpt">
                            <a href="javascript:;" class="btn blue btn-xs disBuy">2020.03.30上线，敬请期待！</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function(){
            $('.detail').on('click',function(){
                var id = $(this).attr('id');
                var route='/admin/apply/'+id+'/edit';
                var data = {bid:'45545',bname:'66666',price:'9999'};
                layer.open({
                    type: 2
                    ,title: ['详情']
                    ,area: ['800px', '440px']
                    ,shadeClose: true
                    ,shade: 0
                    ,maxmin: true
                    ,content:route
                });

            })
        })
    </script>
@endsection