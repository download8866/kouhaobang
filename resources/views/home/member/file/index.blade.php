<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>素材-{{$website->company}}</title>
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

        .zaifabu{position:relative;padding:10px 0;cursor:pointer;}
        .zaifabu .inbox{display:none;position:absolute;left:-76px;top:35px;width:120px;border:1px solid #e6e6e6;background-color: #fff;z-index:2;padding:6px 0;}
        .zaifabu .inbox .fabu-li{display:block;padding:6px 10px;white-space: nowrap; overflow: hidden;text-overflow:ellipsis;border-bottom:1px solid #f5f5f5;}
        .zaifabu .inbox .fabu-li:last-child{border-bottom:none;}
        .zaifabu .inbox .fabu-li:hover{color: #3cb4f9}
        .zaifabu:hover .inbox{display:block;}
        .zaifabu .inbox:before{
            box-sizing: content-box;
            width: 0px;
            height: 0px;
            position: absolute;
            top: -12px;;
            right:16px;
            padding:0;
            border-bottom:6px solid #FFFFFF;
            border-top:6px solid transparent;
            border-left:6px solid transparent;
            border-right:6px solid transparent;
            display: block;
            content:'';
            z-index: 12;
        }
        .zaifabu .inbox:after{
            box-sizing: content-box;
            width: 0px;
            height: 0px;
            position: absolute;
            top: -14px;;
            right:15px;
            padding:0;
            border-bottom:7px solid #cccccc;
            border-top:7px solid transparent;
            border-left:7px solid transparent;
            border-right:7px solid transparent;
            display: block;
            content:'';
            z-index:10
        }
        .zaifabu .inbox .fabu-li:hover{color: #3cb4f9}
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
                            <div class="layui-inline">
                                <label class="layui-form-label">文章标题</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="title" lay-verify="" autocomplete="off" class="layui-input" placeholder="请输入文章标题">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <label class="layui-form-label">日期范围</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="date" id="test6"  placeholder="选择时间范围" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-inline">
                                <button type="submit" class="layui-btn layui-btn-normal layui-btn-sm" lay-submit="" lay-filter="search">搜索</button>
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
                                <td style="width:130px;">素材ID</td>
                                <td style="width:180px;">文章标题</td>
                                <td style="width:70px;">来源链接</td>
                                <td style="width:70px;">备注</td>
                                <td style="width:80px;">提交时间</td>
                                <td style="width:80px;">发布时间</td>
                                <td style="width:130px;">操作</td>
                            </tr>
                        </thead>
                        <tbody id="res-body" class="fz12">
                        
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
            form.on('submit(search)', function(data) {
                var sendobj = data.field;
                sendobj['start_time'] = data.field.date.split(' - ')[0] ||''
                sendobj['end_time'] = data.field.date.split(' - ')[1] ||''
                $('#pagebox').html('')
                getCartList(1,sendobj,layer);
                return false
            });
            getCartList(1,{},layer);
        })
        function getCartList(page,sendobj,layer) {
            layer.load(1);
            var pars = sendobj;
                pars['page'] = page;
                pars['limit'] = 20;
            $.ajax({
                url: "{{route('home.member.active.data')}}",
                type: 'GET',
                data: pars,
                success: function (res) {
                    var html = '',listdata = res.data;
                    listdata.forEach(el => {
                        html += '<tr>'
                                    +'<td>'+ el.random +'</td>'
                                    +'<td>'+ el.title +'</td>'
                                    +'<td><a class="plr5 c-main1" href="'+ el.reference_url +'">查看链接</a></td>'
                                    +'<td>'+ el.mark +'</td>'
                                    +'<td>'+ el.updated_at +'</td>'
                                    +'<td>'+ el.updated_at +'</td>'
                                    +'<td ><a class="mr5 c-main1" href="/active/view/'+ el.random +'" target="_view">预览</a>'
                                    +'<span class="mr5 c-main1 zaifabu" href="javascript:;"><em>再发布</em><div class="inbox">'+ zaifabuFn(el) +'</div></span></td>'
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
        function zaifabuFn(b){
            var html = "",str = "{{$my_apply}}";
            if(str.indexOf('sarticle')>=0){
                html += '<a class="fabu-li" href="/member/sarticle?act='+ b.random +'">软文发布</a>'
            }
            if(str.indexOf('zimeiti')>=0){
                html += '<a class="fabu-li" href="/member/zimeiti?act='+ b.random +'">自媒体发布</a>'
            }
            return html;
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