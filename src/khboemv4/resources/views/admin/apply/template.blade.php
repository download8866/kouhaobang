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
   
    .opt {text-align: center; padding-top:10px;}
    .app-left { padding-top:10px; width: 25%;float: left;}
    .app-left .media-object { border-radius: 15px; width: 80%;display: block; max-width: 100%;height: auto;margin-left: auto;margin-right: auto;}
    .media-heading .gf {padding: 1px 2px !important;font-size: 10px !important;line-height: 1.0 !important; color: #fff  !important;background-color: #2C99FF;border-color: #2C99FF;margin-top: -2px;margin-right: 5px;}
    .app-right { float: right; width: 75%;}
    .cpt .btn-xs {padding: 3px 10px;color: #FFF;border-radius: 3px;line-height: 1.44;font-size:12px;}
    .btn.red {background-color: #e7505a;border-color: #e7505a;}
    .btn.blue{background-color: #3598dc; border-color: #3598dc;}
    .btn.disBuy{background-color: #ccc; border-color: #fff;}

    .tmp-item {background-color: #fff;}
    .tmp-item .simple-img img{width:100%;height:180px;}
    .tmp-item .dobox{padding: 15px;border-top:2px solid #f0f0f0;border-bottom:2px solid #f0f0f0;}
    .price {float:left;}
    .price h4{color:#000;}
    .price p{color:#ef4c2f; text-align: left;font-size:20px;}
    .cpt{float:right;}
</style>
<div class="layui-row layui-col-space10">
    @if(count($data))
        @foreach($data as $item)
            <div class="layui-col-lg3 layui-col-md4 layui-col-xs6">
                <div class="tmp-item">
                    <div class="simple-img" id="{{$item->id}}"><img src="{{$item->logo}}" alt=""></div>
                    <div class="clear dobox">
                        <div class="price" style="">
                            <h4>{{$item->name}}</h4>
                            <p>¥{{$item->price}}</p>
                        </div>
                        <div class="cpt">
                            <a href="{{$item->view_url}}" target="_blank" class="btn red btn-xs">预览</a>
                            @if(!in_array($item->tag,$list))
                            <a href="javascript:;" class="btn blue btn-xs detail" id="{{$item->id}}" tag="{{$item->tag}}">购买</a>
                            @else
                            <a href="javascript:;" class="btn blue btn-xs disBuy">已购买</a>
                            @endif
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
    layui.use(['form'], function(){
        var form = layui.form
        ,layer = layui.layer;
        $('.simple-img').on('click',function(){
            var id = $(this).attr('id');
            var route='/admin/apply/template/'+id+'/edit';
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
        $('.detail').on('click',function(){
            var id = $(this).attr('id');
            var tag = $(this).attr('tag');
            var route='/admin/apply/template/'+id+'/edit?tag='+tag;
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