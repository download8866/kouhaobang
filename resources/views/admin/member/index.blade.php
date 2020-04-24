@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group ">
               {{-- @can('member.member.destroy')
                    <button class="layui-btn layui-btn-sm layui-btn-danger" id="listDelete">删除</button>
                @endcan--}}
                @can('member.member.create')
                    <a class="layui-btn layui-btn-sm" href="{{ route('admin.member.create') }}">添加</a>
                @endcan

            </div>
            <div class="layui-form">
                <div class="layui-input-inline">
                    <input type="text" name="name" id="name" placeholder="请输入用户名" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="qq" id="qq" placeholder="请输入qq" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="phone" id="phone" placeholder="请输入手机号" class="layui-input">
                </div>
                <button class="layui-btn layui-btn-sm" id="memberSearch">搜索</button>
            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script id="statusTpl" type="text/html">
                <input type="checkbox" name="status" lay-filter="status"  lay-skin="switch" lay-text="正常|冻结"   value="@{{ d.id }}" @{{#  if(d.status === 1){ }} checked @{{#  } }}  >
            </script>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    @can('member.member.create')
                        <a class="layui-btn layui-btn-sm" lay-event="edit">编辑</a>
                    @endcan
                </div>
            </script>
            <script type="text/html" id="avatar">
                <a href="@{{d.avatar}}" target="_blank" title="点击查看"><img src="@{{d.avatar}}" alt="" width="28" height="28"></a>
            </script>
        </div>
    </div>
@endsection

@section('script')
    @can('member.member')
        <script>
            layui.use(['layer','table','form'],function () {
                var layer = layui.layer;
                var form = layui.form;
                var table = layui.table;
                //用户表格初始化
                var dataTable = table.render({
                    elem: '#dataTable'
                    ,height: 500
                    ,url: "{{ route('admin.member.data') }}" //数据接口
                    ,where:{model:"member"}
                    ,page: true //开启分页
                    ,limits: [50,100,200]
                    ,limit: 50 //每页默认显示的数量
                    ,cols: [[ //表头
                        {checkbox: true,fixed: true}
                        ,{field: 'id', title: 'ID', sort: true,width:80}
                        ,{field: 'name', title: '登录名'}
                        ,{field: 'phone', title: '注册手机'}
                        ,{field: 'mobile', title: '联系电话'}
                        ,{field: 'qq', title: '联系qq'}
//                        ,{field: 'avatar', title: '头像',toolbar:'#avatar',width:100}
                        ,{field: 'status', title: '状态',templet:'#statusTpl'}
                        ,{field: 'money', title: '账户余额'}
                        ,{field: 'number', title: '下单数量'}
                        // ,{field: 'city', title: '城市'}
                        ,{field: 'created_at', title: '注册时间'}
                        ,{fixed: 'right', width: 120, align:'center', toolbar: '#options'}
                    ]]
                });

                //监听工具条
                table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                    var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                    if(layEvent === 'del'){
                        layer.confirm('确认删除吗？', function(index){
                            $.post("{{ route('admin.member.destroy') }}",{_method:'delete',ids:[data.id]},function (result) {
                                if (result.code==0){
                                    obj.del(); //删除对应行（tr）的DOM结构
                                }
                                layer.close(index);
                                layer.msg(result.msg)
                            });
                        });
                    } else if(layEvent === 'edit'){
                        location.href = '/admin/member/'+data.id+'/edit';
                    }
                });

                //上下架
                form.on('switch(status)', function(data){
                    var id=data.value;
                    var status=data.elem.checked;
                    if(status)
                    {
                        status  = 1;
                    }else{
                        status = 0;
                    }
                    $.post("{{route('admin.member.status')}}",{ids:[id],status:status},function (res) {
                        if(res.code===0){
                            layer.msg(res.info,{icon:1});
                        }else {
                            layer.msg(res.info,{icon:2});
                            dataTable.reload();
                        }
                    })
                });

                //搜索
                $("#memberSearch").click(function () {
                    var userSign = $("#user_sign").val()
                    var name = $("#name").val();
                    var phone = $("#phone").val();
                    var qq = $("#qq").val();
                    dataTable.reload({
                        where:{user_sign:userSign,name:name,phone:phone,qq:qq},
                        page:{curr:1}
                    })
                })
            })
        </script>
    @endcan
@endsection



