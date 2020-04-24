@extends('admin.base')
@section('content')
    <div class="layui-row layui-col-space15">

        <div class="layui-col-md8">

            <div class="layui-row layui-col-space15">

                <div class="layui-col-md6">

                    <div class="layui-card">

                        <div class="layui-card-header">订单数据</div>

                        <div class="layui-card-body">

                            <div class="layui-carousel layadmin-carousel layadmin-backlog">

                                <div carousel-item>

                                    <ul class="layui-row layui-col-space10">

                                        <li class="layui-col-xs6">

                                            <a  class="layadmin-backlog-body">

                                                <h3>待接单</h3>

                                                <p><cite>{{$data['order']['wait']??0}}</cite></p>

                                            </a>

                                        </li>

                                        <li class="layui-col-xs6">

                                            <a  class="layadmin-backlog-body">
                                                <h3>执行中</h3>

                                                <p><cite>{{$data['order']['accept']??0}}</cite></p>

                                            </a>

                                        </li>

                                        <li class="layui-col-xs6">

                                            <a  class="layadmin-backlog-body">
                                                <h3>已完成</h3>

                                                <p><cite>{{$data['order']['complete']??0}}</cite></p>

                                            </a>

                                        </li>

                                        <li class="layui-col-xs6">

                                            <a  class="layadmin-backlog-body">

                                                <h3>已取消</h3>

                                                <p><cite>{{$data['order']['channel']??0}}</cite></p>

                                            </a>

                                        </li>

                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="layui-col-md6">

                    <div class="layui-card">

                        <div class="layui-card-header">资源数据</div>

                        <div class="layui-card-body">

                            <div class="layui-carousel layadmin-carousel layadmin-backlog">

                                <div carousel-item>

                                    <ul class="layui-row layui-col-space10">

                                        <li class="layui-col-xs6">

                                            <a  class="layadmin-backlog-body">

                                                <h3>资源总量</h3>

                                                <p><cite>{{$data['product']['total']??0}}</cite></p>

                                            </a>

                                        </li>

                                        <li class="layui-col-xs6">

                                            <a  class="layadmin-backlog-body">
                                                <h3>已上架</h3>

                                                <p><cite>{{$data['product']['up']??0}}</cite></p>

                                            </a>

                                        </li>

                                        <li class="layui-col-xs6">

                                            <a  class="layadmin-backlog-body">
                                                <h3>已新增</h3>

                                                <p><cite>{{$data['product']['down']??0}}</cite></p>

                                            </a>

                                        </li>

                                       {{-- <li class="layui-col-xs6">

                                            <a  class="layadmin-backlog-body">

                                                <h3>待上架</h3>

                                                <p><cite>20</cite></p>

                                            </a>

                                        </li>--}}

                                    </ul>


                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="layui-col-md12">

                    <div class="layui-card">

                        <div class="layui-card-header">数据概览</div>

                        <div class="layui-card-body">
                            <div id="userLine" style="height:200px;"></div>
                            <div id="chargeLine" style="height:200px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">统计数据</div>
                <div class="layui-card-body">
                    <div class="layui-carousel layadmin-carousel layadmin-backlog">
                        <div carousel-item>
                            <ul class="layui-row layui-col-space10">
                                <li class="layui-col-xs6">
                                    <a  class="layadmin-backlog-body">
                                        <h3>今日注册</h3>
                                        <p><cite>{{$data['user']['today']}}</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-xs6">
                                    <a class="layadmin-backlog-body">
                                        <h3>累计注册</h3>
                                        <p><cite>{{$data['user']['total']}}</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-xs6">
                                    <a  class="layadmin-backlog-body">
                                        <h3>今日充值</h3>
                                        <p><cite>{{$data['charge']['today']}}</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-xs6">
                                    <a  class="layadmin-backlog-body">
                                        <h3>累计充值</h3>
                                        <p><cite>{{$data['charge']['total']}}</cite></p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="layui-card">
                <style>.line-clamp1 {overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;}.layui-colla-title{background-color:#fff;}.versions{font-size:20px;color:red;}.versions a{font-size:16px;color:red;padding:8px;margin-top:-18px;cursor:pointer;}</style>
                <div class="layui-card-header versions">
                    当前版本   V{{$install?$install->version:'4.0.0'}}
                    @if($install)
                        <a class="layui-badge layui-bg-blue layuiadmin-badge basic_install" data="{{$install->id}}">立即更新</a>
                    @else
                        <a class="layui-badge layui-bg-blue layuiadmin-badge basic_install">立即更新</a>
                    @endif
                </div>
                
                <div class="layui-card-header">实时推荐</div>
                <div class="layui-card-body" style="height:356px;overflow:auto;">
                    <div class="layui-collapse" lay-filter="test">
                        @if(count($khb_notice))
                            @foreach($khb_notice  as $item)
                                <div class="layui-colla-item">
                                    <h2 class="layui-colla-title line-clamp1">{{$item['title']}}</h2>
                                    <div class="layui-colla-content">
                                     {!!$item['content']!!}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['index','console', 'echarts'],function(){
            var element = layui.element,
            $ = layui.jquery,
            echarts = layui.echarts;
            $.ajax({
                url: "{{route('admin.echart.data')}}",
                type: 'POST',
                data: '',
                success: function (res) {
                    drawUserLine(res.data.week, res.data.user)
                    drawChargeLine(res.data.week, res.data.charge)
                },
                error: function () {}
            })
            function drawUserLine(x,data){
                var userLine = echarts.init(document.getElementById('userLine'));
                //指定图表配置项和数据
                var optionchart = {
                    title: {
                        text: "最近一周新增用户量",
                        x: "center",
                        textStyle: {
                            fontSize: 14
                        }
                    },
                    tooltip: {
                        trigger: "axis"
                        // formatter: "{b}<br>新增用户：{c}"
                    },
                    xAxis: [{
                        type: "category",
                        boundaryGap: false,
                        axisLine: {
                            lineStyle: {
                                color: '#cccccc'
                            }
                        },
                        data: x
                    }],
                    yAxis: [{
                        type: "value",
                        axisLine: {
                            lineStyle: {
                                color: '#cccccc'
                            }
                        },
                    }],
                    series: [
                        {
                            name: "新增用户",
                            type: "line",
                            smooth: true,
                            itemStyle : { 
                                normal : { 
                                    color:'#01AAED', //改变折线点的颜色
                                    lineStyle:{ 
                                        color:'#01AAED' //改变折线颜色
                                    } 
                                } 
                            },
                            data: data
                        }
                    ]
                }
                userLine.setOption(optionchart);
            }
            function drawChargeLine(x,data){
                var chargeLine = echarts.init(document.getElementById('chargeLine'));
                //指定图表配置项和数据
                var optionchart = {
                    title: {
                        text: "最近一周新增充值",
                        x: "center",
                        textStyle: {
                            fontSize: 14
                        }
                    },
                    tooltip: {
                        trigger: "axis"
                        // formatter: "{b}<br>新增用户：{c}"
                    },
                    xAxis: [{
                        type: "category",
                        boundaryGap: false,
                        axisLine: {
                            lineStyle: {
                                color: '#cccccc'
                            }
                        },
                        data: x
                    }],
                    yAxis: [{
                        type: "value",
                        axisLine: {
                            lineStyle: {
                                color: '#cccccc'
                            }
                        },
                    }],
                    series: [
                        {
                            name: "新增充值",
                            type: "line",
                            smooth: true,
                            itemStyle : { 
                                normal : { 
                                    color:'#01AAED', //改变折线点的颜色
                                    lineStyle:{ 
                                        color:'#01AAED' //改变折线颜色
                                    } 
                                } 
                            },
                            data: data
                        }
                    ]
                }
                chargeLine.setOption(optionchart);
            }
            $(".basic_install").click(function () {
                var  id = $(this).attr('data')
                if(id <= 0)
                {
                    layer.msg('已经是最新版本了')
                }else{
                    layer.confirm('确认更新吗？', function(index){
                        $.post("{{ route('admin.download') }}",{id:id},function (result) {
                            if(result.code == 0){
                                layer.msg(result.info,{icon:1});
                                setTimeout(function () {
                                   window.location.reload()
                                },1500);
                            }else {
                                layer.msg(result.info,{icon:2});
                            }
                        });
                    })
                }

            });

        });
    </script>
    
@endsection