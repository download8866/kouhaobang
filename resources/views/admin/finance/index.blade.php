@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">

            <div class="layui-form" >
                <div class="layui-input-inline">
                    <select name="type" lay-verify="required" id="type">
                        <option value="">请选择分类</option>
                        <option value="2">账户充值</option>
                        <option value="1">账户消费</option>
                        <option value="3">订单退款</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" placeholder="开始时间" name="start_time" id="start_time">
                </div>
                <div class="layui-form-mid layui-word-aux" style="float:none;display: inline;margin-right: 0">-</div>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" placeholder="结束时间" name="end_time" id="end_time">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="mobile" id="mobile" placeholder="请输入用户电话" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="username" id="username" placeholder="请输入用户姓名" class="layui-input">
                </div>
                <button class="layui-btn layui-btn-sm" id="searchBtn">搜 索</button>
            </div>
            <button class="layui-btn layui-btn-sm" id="export">导  出</button>
            <a class="layui-btn layui-btn-sm" id="charge">充 值</a>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
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
                    ,url: "{{ route('admin.finance.data') }}" //数据接口
                    ,page: true //开启分页
                    ,limits: [50,100,200]
                    ,limit: 50 //每页默认显示的数量
                    ,cols: [[ //表头
                        {checkbox: true,fixed: true}
                        ,{field: 'id', title: 'ID', sort: true,width:80}
                        ,{field: 'username', title: '用户姓名',templet: function(d){
                            if(d.member.username)
                            {
                                return d.member.username;
                            }else{
                                return ''
                            }
                        }}
                        ,{field: 'phone', title: '用户电话',templet: function(d){
                            if(d.member.mobile)
                            {
                                return d.member.mobile;
                            }else{
                                return d.member.phone
                            }
                        }}
                        ,{field: 'money', title: '交易金额'}
                        ,{field: 'type', title: '交易类型',templet: function(d){
                            if(d.type == 1)
                            {
                                return '用户下单';
                            }else if(d.type == 2){
                                return '用户充值'
                            }else if(d.type == 3){
                                return '用户退单'
                            }else if(d.type == 4){
                                return '后台充值'
                            }else if(d.type == 5){
                                return '用户申请退款'
                            }
                        }}
                        ,{field: 'total_money', title: '可用余额'}
                        ,{field: 'order_no', title: '订单号'}
                        ,{field: 'product_name', title: '资源名称'}
                        ,{field: 'mark', title: '备注'}
                        ,{field: 'created_at', title: '操作时间'}

                    ]]
                });

                //搜索
                laydate.render({
                    elem: "#start_time",
                });
                laydate.render({
                    elem: "#end_time",
                });
                //搜索
                $("#searchBtn").click(function () {
                    var type = $("#type").val()
                    var start_time = $("#start_time").val()
                    var end_time = $("#end_time").val();
                    var mobile = $("#mobile").val();
                    var username = $("#username").val();
                    dataTable.reload({
                        where:{type:type,start_time:start_time,
                            end_time:end_time,mobile:mobile,username:username},
                        page:{curr:1}
                    })
                })

                //excel
                $("#export").click(function () {
                    var ids = []
                    var hasCheck = table.checkStatus('dataTable')
                    var hasCheckData = hasCheck.data
                    if (hasCheckData.length>0){
                        $.each(hasCheckData,function (index,element) {
                            ids.push(element.id)
                        })
                    }
                    var type = $("#type").val()
                    var start_time = $("#start_time").val()
                    var end_time = $("#end_time").val();
                    var mobile = $("#mobile").val();
                    var username = $("#username").val();
                    window.location.href="{{ route('admin.finance.export') }}"+"?ids="+ids+"&type"+type+"&start_time"+start_time+"&end_time"+end_time+"&mobile"+mobile+"&username"+username;
                })

                $("#charge").click(function () {
                    var route="{{route('admin.finance.create')}}";
                    var data = {bid:'45545',bname:'66666',price:'9999'};
                    layer.open({
                        type: 2
                        ,title: ['账户余额充值']
                        ,area: ['1100px', '600px']
                        ,shadeClose: true
                        ,shade: 0
                        ,maxmin: true
                        ,content:route
                    });
                })
            })
        </script>
@endsection