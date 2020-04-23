@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">
                <a class="layui-btn layui-btn-sm" id="ticket_create">添 加</a>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    <a class="layui-btn layui-btn-sm" lay-event="edit">查看</a>
                </div>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('pay.message')
        <script>
            layui.use(['layer','table','form'],function () {
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;

                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    // ,height: 500
                    ,url: "{{ route('admin.ticket.data') }}" //数据接口
//                ,page: true //开启分页
                    ,cols: [[ //表头
                        //{field: 'id', title: '工单号'}
                        {field: 'type', title: '业务性质',templet:function (d) {
                            if(d.type == 1){
                                return '系统';
                            }else if(d.type ==  2){
                                return '运营';
                            }else if(d.type ==  3){
                                return '资源';
                            }else if(d.type ==  4){
                                return '意见反馈';
                            }else if(d.type ==  5){
                                return '投诉';
                            }else{
                                return '系统';
                            }
                        }}
                        ,{field: 'title', title: '工单标题'}
                        ,{field: 'status', title: '工单状态',templet:function (d) {
                            if(d.status == 0){
                                return '待处理';
                            }else if(d.type == 1){
                                return '处理中';
                            }else{
                                return '已完成';
                            }
                        }}
                        ,{fixed: 'right', title:'操作',width: 100, align:'center', toolbar: '#options'}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                    if(layEvent === 'edit'){
                        var html = '<div>'
                            +'<div><span style="float: left;">标题：</span><p style="margin-left: 50px;color:red;">'+ data.title +'</p></div>'
                            +'<div><span style="float: left;">时间：</span><p style="margin-left: 50px;">'+ data.created_at +'</p></div>'
                            +'<div><span style="float: left;">内容：</span><div style="margin-left: 50px;">'+data.content+'</div></div>'
                        +'</div>'
                        layer.open({
                            title:"工单详情",
                            area:['600px','400px'],
                            content:html,
                            btn: false,
                            yes:function(){
                                
                            },
                        });
                    }
                });

                $("#ticket_create").click(function () {
                    var route="{{route('admin.ticket.create')}}";
                    var data = {bid:'45545',bname:'66666',price:'9999'};
                    layer.open({
                        type: 2
                        ,title: ['编辑软文资源']
                        ,area: ['1100px', '600px']
                        ,shadeClose: true
                        ,shade: 0
                        ,maxmin: true
                        ,content:route
                    });
                });
            })
        </script>
    @endcan
@endsection