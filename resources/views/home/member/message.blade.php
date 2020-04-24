<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>公告</title>
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    
    <link rel="stylesheet" href="/static/home/layui/css/layui.css" media="all">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>
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
        #res-body {min-height:60vh;}
        #res-body li {border-bottom: 1px solid #f5f5f5;cursor:pointer;}
        #res-body li:hover {background:#f9f9f9;}
    </style>
</head>
<body>
    
    @include('home.member.header')
    <div class="wrap clear mtop bgff radius">
        <ul class="fz16 clear pl20 status-ul">
            <li class="on" data-val="">公告通知</li>
            <!-- <li class="" data-val="2">公告通知</li>
            <li class="" data-val="5">反馈通知</li>
            <li class="" data-val="7">功能上线</li>
            <li class="" data-val="4">审核通知</li>
            <li class="" data-val="4">签约解约</li> -->
        </ul>
        <div class="ptb20 ">
            <ul id="res-body"></ul>
            <div id="pagebox"></div>
        </div>
    </div>
    @include('home.member.icp')
    <script>
        layui.use(['form'], function(){
            var form = layui.form
            ,layer = layui.layer
            getCartList(1,{},layer);
        })
        
        function getCartList(page,sendobj,layer) {
            layer.load(1);
            var pars = sendobj;
                pars['page'] = page;
                pars['limit'] = 20;
            $.ajax({
                url: "{{route('home.member.message.data')}}",
                type: 'GET',
                data: pars,
                success: function (res) {
                    var html = '', listdata = res.data;
                    listdata.forEach(function(el){
                        html += '<li class="clear p20">'
                                    +'<div class="fl" style="width:80%;">'
                                        +'<p class="fz16 mb10">'+ el.title +'</p>'
                                        +'<p class="pcub-te c-666">'+ el.content +'</p>'
                                    +'</div>'
                                    +'<div class="fr c-666">'+ el.updated_at +'</div>'
                                +'</li>'
                    }) 
                    html = html || '<li class="tx-c p20">暂无数据</li>';
                    $('#res-body').html(html);
                    delOrder(page,sendobj,layer)
                    cutPage(Math.ceil(res.total/pars['limit'])||1, sendobj,layer);
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
     
        function delOrder(page, sendobj, layer){
            $('#res-body li').on('click',function(){
                var _this = this;
                layer.open({
                    type: 1
                    ,area:['600px','400px']
                    ,title: '详情'
                    ,content: '<div class="p20">'+ $(_this).find('.pcub-te').html() +'</div>'
                    ,yes: function(index, layero){
                        window.location.href = url;
                    }
                })
            })
        }
        function cutPage(page,b,layer){
            if($('#pagebox').html()){
                return
            }
            var slp = new SimplePagination(page)
            slp.init({
                container: '#pagebox',
                maxShowBtnCount: 3,
                onPageChange: function(state) {
                    getCartList(state.pageNumber, b, layer)
                }
            })
            // slp.gotoPage(2) 跳转第二页
        }
    </script>
</body>
</html>