<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>财务列表{{$website->company}}</title>
    <link rel="stylesheet" href="/template/modules/css/icon.css">
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>

    <link rel="stylesheet" href="/static/home/layui/css/layui.css" media="all">
    <script src="/static/home/layui/layui.js"></script>

    <link rel="stylesheet" href="/template/modules/page/page.css">
    <script src="/template/modules/page/page.js"></script>
    <style>
        .pagination .page-li.page-active{border-color: #3cb4f9;background-color: #3cb4f9;}
        table {width: 100%; text-align: center;table-layout: fixed;}
        table tr{border-top: 1px solid #f5f5f5;box-sizing:border-box;}
        table tr td{padding:15px 0;border:1px solid #f5f5f5;}
        table tbody tr:hover{background:#f9f9f9;}
        
        .status-ul li{border-bottom:2px solid #ffffff;cursor: pointer;padding:10px;float: left;margin-right:20px;}
        .status-ul li.on{border-bottom-color: #4eb6ff;color: #4eb6ff;}
        .layui-input{height:30px;}
        .layui-form-label{padding-top:4px;padding-bottom:4px;padding-left:0;}
    </style>
</head>
<body>
   @include('home.member.header')
    <div class="wrap clear mtop">
        <div class="fl">
            @include('home.member.menu')
        </div>
        <div class="fr" style="width:980px">
            <div class="bgff radius">
                <div class="fz14 pt20 pb10">
                    <form class="layui-form" action="">
                        <div class="layui-form-item">
                            <div class="layui-inline" >
                                <ul class="fz16 clear pl20 status-ul" style="margin-right:180px;">
                                    <li class="on" data-val="">全部</li>
                                    <li class="" data-val="1">消费记录</li>
                                    <li class="" data-val="2">充值记录</li>
                                </ul>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">日期范围</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="date" id="test6"  placeholder="选择时间范围" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <button type="submit" class="layui-btn layui-btn-normal layui-btn-sm" lay-submit="" lay-filter="search">搜索</button>
                                <button type="submit" class="layui-btn layui-btn-normal layui-btn-sm" lay-submit="" lay-filter="export">导出EXCEL</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bgff mt20 ptb20 radius">
                <div class="plr20">
                    <table class="fz14">
                        <thead>
                            <tr>
                                <td style="width:130px;">订单号</td>
                                <td style="width:180px;">交易媒体</td>
                                <td style="width:70px;">交易说明</td>
                                <td style="width:60px;">交易金额</td>
                                <td style="width:60px;">账户余额</td>
                                <td style="width:130px;">交易时间</td>
                                <td style="width:60px;">交易状态</td>
                            </tr>
                        </thead>
                        <tbody id="res-body" class="fz14">
                        
                        </tbody>
                    </table>
                </div>
                <div id="pagebox"></div>
            </div>
        </div>
    </div>
   @include('home.member.icp')
  
    <script>
        layui.use(['form', 'laydate'], function(){
            var form = layui.form
            ,layer = layui.layer
            ,laydate = layui.laydate
            laydate.render({
                elem: '#test6'
                ,range: true
            });
            $('.status-ul li').on('click',function(){
                $('.status-ul li').removeClass('on')
                $(this).addClass('on');
                $('.layui-input').val('')
                $('#pagebox').html('')
                getCartList(1,{type: $(this).attr('data-val')},layer);
            })
            form.on('submit(search)', function(data) {
                var sendobj = {};
                $('.status-ul li').each(function(){
                    if($(this).hasClass('on')){
                        sendobj['type'] = $(this).attr('data-val')
                    }
                })
                sendobj['start_time'] =  data.field.date.split(' - ')[0] || ''
                sendobj['end_time'] =  data.field.date.split(' - ')[1] || ''
                $('#pagebox').html('')
                getCartList(1,sendobj,layer);
                return false
            });
            form.on('submit(export)', function(data) {
                var sendobj = {}, url = '/member/finance/export';
                sendobj['start_time'] = data.field.date.split(' - ')[0] || ''
                sendobj['end_time'] = data.field.date.split(' - ')[1] || ''
                $('.status-ul li').each(function(){
                    if($(this).hasClass('on')){
                        sendobj['type'] = $(this).attr('data-val')
                    }
                })
                for(var k in sendobj){
                    if(sendobj[k]){
                        url += '&' + k + '=' + sendobj[k];
                    }
                }
                url = url.replace('&','?')
                window.location.href = url;
                return false
            });
            getCartList(1,{},layer);
        })
        function getCartList(page,sendobj,layer) {
            layer.load(1);
            var pars = sendobj;
                pars['page'] = page;
                pars['limit'] = 10;
            $.ajax({
                url: "{{route('home.member.finance.data')}}",
                type: 'GET',
                data: pars,
                success: function (res) {
                    var html = '',listdata = res.data;
                    listdata.forEach(el => {
                        html += '<tr>'
                                    +'<td >'+ el.order_no +'</td>'
                                    +'<td style="">'+ el.product_name +'</td>'
                                    +'<td style="">'+ el.mark +'</td>'
                                    if(el.type==1){
                                        html += ('<td style="color:red; ">- '+ el.money +'</td>')
                                    }else{
                                        html += ('<td style="color:green;">+ '+ el.money +'</td>')
                                    }
                                   
                                    html += '<td style="">'+ el.total_money +'</td>'
                                    +'<td style="">'+ el.updated_at +'</td>'
                                    +'<td style="color:green;">成功</td>'
                                +'</tr>'
                    })
                    html = html || '<tr align="center"><td height="25" colspan="7">暂无数据</td></tr>';
                    $('#res-body').html(html)
                    cutPage(Math.ceil(res.total/pars['limit'])||1,sendobj,layer)
                    setTimeout(function(){
                        layer.closeAll('loading');
                    },200)
                },
                error: function () {
                    setTimeout(function(){
                        layer.closeAll('loading');
                    },200)
                }
            })
        }
        function cutPage(page,sendobj,layer){
            if($('#pagebox').html()){
                return
            }
            var slp = new SimplePagination(page)
            slp.init({
                container: '#pagebox',
                maxShowBtnCount: 3,
                onPageChange: function(state) {
                    getCartList(state.pageNumber,sendobj,layer)
                }
            })
            // slp.gotoPage(2) 跳转第二页
        }
    </script>
</body>
</html>