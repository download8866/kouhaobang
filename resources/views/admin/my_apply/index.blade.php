@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">


        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    <a class="layui-btn layui-btn-sm" lay-event="update">更新</a>
                    @{{#  if(d.status == 1){ }}
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="stop">停用</a>
                    @{{#  }else{ }}
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="install">安装</a>
                    @{{#  } }}
                </div>
            </script>
            <script type="text/html" id="thumb">
                <a href="@{{d.thumb}}" target="_blank" title="点击查看"><img src="@{{d.thumb}}" alt="" width="28" height="28"></a>
            </script>
        </div>
    </div>
@endsection

@section('script')
        <script>
            layui.use(['layer','table','form','laydate'],function () {
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                var laydate = layui.laydate;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    ,height: 500
                    ,url: "{{ route('admin.my.apply.data') }}" //数据接口
                    ,page: true //开启分页
                    ,cols: [[ //表头
                        {field: 'name', title: '名称'}
                        ,{field: 'price', title: '价格'}
                        ,{field: 'created_at', title: '购买时间'}
                        ,{field: 'expire_at', title: '到期时间'}
                        ,{field: 'author', title: '开发者'}
                        ,{fixed: 'right', width: 220, align:'center', toolbar: '#options'}
                    ]]
                });  

                //监听工具条
                table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                    if(layEvent === 'stop'){
                        layer.confirm('确认停用吗？', function(index){
                            $.post("{{ route('admin.my.apply.install') }}",{id:[data.id],'status':0},function (res) {
                                if(res.code===0){
                                    layer.msg(res.info,{icon:1});
                                    setTimeout(function () {
                                        dataTable.reload()
                                    },1500);
                                }else {
                                    layer.msg(res.info,{icon:2});
                                }
                            });
                        });
                    } else if(layEvent === 'install'){
                        layer.confirm('确认安装吗？', function(index){
                            $.post("{{ route('admin.my.apply.install') }}",{id:[data.id],'status':1},function (res) {
                            if(res.code===0){
                                layer.msg(res.info,{icon:1});
                                setTimeout(function () {
                                    dataTable.reload()
                                },1500);
                            }else {
                                layer.msg(res.info,{icon:2});
                            }
                            });
                        });
                    }else if(layEvent === 'update'){
                        layer.confirm('确认更新吗？', function(index){
                            $.post("{{ route('admin.my.apply.update') }}",{id:data.id,'type':'apply'},function (res) {
                                if(res.code===0){
                                    layer.msg(res.info,{icon:1});
                                    setTimeout(function () {
                                        dataTable.reload()
                                    },1500);
                                }else {
                                    layer.msg(res.info,{icon:2});
                                }
                            });
                        });
                    }
                });

                @can('zixun.article.edit')
                //监听是否显示
                form.on('switch(isShow)', function(obj){
                    var index = layer.load();
                    var url = $(obj.elem).attr('url')
                    var data = {
                        "is_show" : obj.elem.checked==true?1:0,
                        "_method" : "put"
                    }
                    $.post(url,data,function (res) {
                        layer.close(index)
                        layer.msg(res.msg)

                    },'json');
                });
                @endcan

                //搜索
                $("#searchBtn").click(function () {
                    var catId = $("#category_id").val()
                    var title = $("#title").val();

                    dataTable.reload({
                        where:{category_id:catId,title:title,start_time:start_time,end_time:end_time},
                        page:{curr:1}
                    })
                })
            })
        </script>
@endsection