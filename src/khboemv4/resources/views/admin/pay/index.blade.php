@extends('admin.base')

@section('content')
    <div class="layui-card">
        <div class="layui-card-header layuiadmin-card-header-auto">
            <div class="layui-btn-group">

            </div>
        </div>
        <div class="layui-card-body">
            <table id="dataTable" lay-filter="dataTable"></table>
            <script type="text/html" id="options">
                <div class="layui-btn-group">
                    <a class="layui-btn layui-btn-sm" lay-event="edit">配置</a>
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
                ,url: "{{ route('admin.pay.data') }}" //数据接口
//                ,page: true //开启分页
                ,cols: [[ //表头
                    {field: 'id', title: '编号'}
                    ,{field: 'type', title: '类型',templet:function (d) {
                            if(d.type == 'public'){
                                return '对公转账';
                            }else if(d.type == 'alipay'){
                                return '支付宝';
                            }else{
                                return '扫码支付';
                            }
                        }
                    }

                    ,{field: 'status', title: '开启状态',templet:function (d) {
                            if(d.status == 1){
                                return '启用中';
                            }else{
                                return '去配置';
                            }
                        }
                    }
                    ,{field: 'explain', title: '说明',templet:function (d) {
                       if(d.type == 'alipay'){
                            return '对公';
                        }else{
                            return '对私';
                        }
                    }
                    }
                    ,{fixed: 'right', title:'操作',width: 100, align:'center', toolbar: '#options'}
                ]]
            });

            //监听工具条
            table.on('tool(dataTable)', function(obj){ //注：tool是工具条事件名，dataTable是table原始容器的属性 lay-filter="对应的值"
                var data = obj.data //获得当前行数据
                        ,layEvent = obj.event; //获得 lay-event 对应的值
                if(layEvent === 'edit'){
                    location.href = '/admin/pay/'+data.id+'/edit';
                }
            });
        })
    </script>
    @endcan
@endsection