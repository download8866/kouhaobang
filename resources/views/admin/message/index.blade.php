@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group ">
                @can('message.message.destroy')
                    <button class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">删除</button>
                @endcan
                @can('message.message.create')
                    <span class="layui-btn layui-btn-sm" id="create_message">添加</span>
                @endcan

            </div>
            <div class="layui-form" >
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" placeholder="开始时间" name="start_time" id="start_time">
                </div>
                <div class="layui-form-mid layui-word-aux" style="float:none;display: inline;margin-right: 0">-</div>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" placeholder="结束时间" name="end_time" id="end_time">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="title" id="title" placeholder="请输入消息标题" class="layui-input" >
                </div>
                <button type="button" class="layui-btn layui-btn-sm" id="searchBtn">搜索</button>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('message.message.destroy')
                        <a class="layui-btn  layui-btn-sm" lay-event="edit">编辑</a>
                        <a class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">删除</a>
                    @endcan
                </div>
            </script>
            <script type="text/html" id="read">
                <input disabled type="checkbox" lay-skin="switch" lay-text="未读|已读" @{{ d.read==1?'checked':'' }} >
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('message.message')
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
                    ,url: "{{ route('admin.message.data') }}" //数据接口
                    ,page: true //开启分页
                    ,cols: [[ //表头
                        {checkbox: true,fixed: true}
                        ,{field: 'id', title: 'ID', sort: true,width:80}
                        ,{field: 'flag', title: '类型',templet:function(d){
                               if(d.flag == 2 )
                               {
                                    return  '系统公告';
                               }else{
                                    return  '推送信息';
                               }
                            }}
                        ,{field: 'title', title: '标题'}
                        ,{field: 'content', title: '内容'}
                        ,{field: 'created_at', title: '创建时间'}
                        ,{fixed: 'right', width: 220, align:'center', toolbar: '#options',width:100}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                    if(layEvent === 'del'){
                        layer.confirm('确认删除吗？', function(index){
                            $.post("{{ route('admin.message.destroy') }}",{_method:'delete',ids:[data.id]},function (result) {
                                if (result.code==0){
                                    obj.del(); //删除对应行（tr）的DOM结构
                                }
                                layer.close(index);
                                layer.msg(result.msg)
                            });
                        });
                    } else if(layEvent === 'edit'){

                        var route='/admin/message/'+data.id+'/edit';
                        var data = {bid:'45545',bname:'66666',price:'9999'};
                        layer.open({
                            type: 2
                            ,title: ['编辑公告']
                            ,area: ['700px', '600px']
                            ,shadeClose: true
                            ,shade: 0
                            ,maxmin: true
                            ,content:route
                        });
                       // location.href = '/admin/message/'+data.id+'/edit';
                    }
                });

                //按钮批量删除
                $("#listDelete").click(function () {
                    var ids = []
                    var hasCheck = table.checkStatus('dataTable')
                    var hasCheckData = hasCheck.data
                    if (hasCheckData.length>0){
                        $.each(hasCheckData,function (index,element) {
                            ids.push(element.id)
                        })
                    }
                    if (ids.length>0){
                        layer.confirm('确认删除吗？', function(index){
                            $.post("{{ route('admin.message.destroy') }}",{_method:'delete',ids:ids},function (result) {
                                if (result.code==0){
                                    dataTable.reload()
                                }
                                layer.close(index);
                                layer.msg(result.msg,)
                            });
                        })
                    }else {
                        layer.msg('请选择删除项')
                    }
                });

                //搜索
                laydate.render({
                    elem: "#start_time",
                });
                laydate.render({
                    elem: "#end_time",
                });
                $("#searchBtn").click(function () {
                    var start_time = $("#start_time").val()
                    var end_time = $("#end_time").val();
                    var title = $("#title").val();
                    dataTable.reload({
                        where:{start_time:start_time,end_time:end_time,title},
                        page:{curr:1}
                    })
                })


                $("#create_message").click(function () {
                    var route="{{route('admin.message.create')}}";
                    var data = {bid:'45545',bname:'66666',price:'9999'};
                    layer.open({
                        type: 2
                        ,title: ['新增公告']
                        ,area: ['700px', '600px']
                        ,shadeClose: true
                        ,shade: 0
                        ,maxmin: true
                        ,content:route
                    });
                })
            })
        </script>
    @endcan
@endsection