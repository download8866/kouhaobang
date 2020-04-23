<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>软文-{{$website->company}}</title>
    <link rel="stylesheet" href="/template/modules/css/reset.css">
    <link rel="stylesheet" href="/template/modules/css/icon.css">
    <link rel="stylesheet" href="/template/a/css/filter.css">
    <link rel="stylesheet" href="/template/a/css/datatables.css">
    <script src="/template/modules/js/jquery-1.8.3.min.js"></script>

    <link rel="stylesheet" href="/template/modules/page/page.css">
    <script src="/template/modules/page/page.js"></script>
</head>
<body>
    @include('home.template.a.header')
    <div class="page">
        <div class="top_banner">
            <div class="main">
                <div class="filter" id="filter">
                    <div class="filter-item filter-clear">
                        <div class="filter-label">频道分类：</div>
                        <ul class="filter-list filter-clear" data-type="channel">
                            <li class="filter-option active" data-value="">不限</li>
                            @if(count($where['channels']))
                                @foreach($where['channels']  as $item)
                                    <li class="filter-option" data-value="{{$item->id}}">{{$item->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="filter-item filter-clear">
                        <div class="filter-label">综合门户：</div>
                        <ul class="filter-list filter-clear" data-type="portal">
                            <li class="filter-option active" data-value="">不限</li>
                            @if(count($where['portals']))
                                @foreach($where['portals']  as $item)
                                    <li class="filter-option" data-value="{{$item->id}}">{{$item->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="filter-item filter-clear">
                        <div class="filter-label">覆盖区域：</div>
                        <ul class="filter-list filter-clear" data-type="district">
                            <li class="filter-option active" data-value="0">不限</li>
                            @if(count($where['districts']))
                                @foreach($where['districts']  as $item)
                                    <li class="filter-option" data-value="{{$item->id}}">{{$item->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="filter-item filter-clear">
                        <div class="filter-label">资源价格：</div>
                        <ul class="filter-list filter-clear" data-type="price">
                            <li class="filter-option active" data-value="">不限</li>
                            @if(count($where['prices']))
                                @foreach($where['prices']  as $item)
                                    <li class="filter-option" data-value="{{$item->id}}">
                                        {{$item->min}}
                                        @if($item->max == 0)
                                            以上
                                        @else
                                            -{{$item->max}}
                                        @endif
                                        </li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                    <div class="filter-item filter-clear">
                        <div class="filter-label">网站类型：</div>
                        <ul class="filter-list filter-clear" data-type="website">
                            <li class="filter-option active" data-value="">不限</li>
                            @if(count($where['websites']))
                                @foreach($where['websites']  as $item)
                                    <li class="filter-option" data-value="{{$item->id}}">{{$item->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="filter-item filter-clear" data-hide="1">
                        <div class="filter-label">收录类型：</div>
                        <ul class="filter-list filter-clear" data-type="collect">
                            <li class="filter-option active" data-value="">不限</li>
                            @if(count($where['collects']))
                                @foreach($where['collects']  as $item)
                                    <li class="filter-option" data-value="{{$item->id}}">{{$item->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="filter-item filter-clear" data-hide="1">
                        <div class="filter-label">链接类型：</div>
                        <ul class="filter-list filter-clear" data-type="accept_link">
                            <li class="filter-option active" data-value="">不限</li>
                              <li class="filter-option" data-value="1">可带链接</li>
                              <li class="filter-option" data-value="0">不可带链接</li>
                        </ul>
                    </div>
                    <div class="filter-item filter-clear" data-hide="1">
                        <div class="filter-label">特殊行业：</div>
                        <ul class="filter-list filter-clear" data-type="special">
                            <li class="filter-option active" data-value="">不限</li>
                            @if(count($where['special']))
                                @foreach($where['special']  as $item)
                                    <li class="filter-option" data-value="{{$item->id}}">{{$item->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="filter-item filter-clear" data-hide="1">
                        <div class="filter-label">入口级别：</div>
                        <ul class="filter-list filter-clear" data-type="entrance">
                            <li class="filter-option active" data-value="">不限</li>
                            @if(count($where['entrances']))
                                @foreach($where['entrances']  as $item)
                                    <li class="filter-option" data-value="{{$item->id}}">{{$item->name}}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="filter-item filter-clear" data-hide="1">
                        <div class="filter-label">出稿时间：</div>
                        <ul class="filter-list filter-clear" data-type="time">
                            <li class="filter-option active" data-value="">不限</li>
                            @if(count($where['times']))
                                @foreach($where['times']  as $item)
                                    <li class="filter-option" data-value="{{$item->id}}">
                                        {{$item->min}}
                                        @if($item->max == 0)
                                            小时以上
                                        @else
                                            -{{$item->max}}小时
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="ptb10 tx-c bgff bb"> <a href="javascript:;" class="c-main1 filter-item-more" data-hide="1">更多<i class="iconfont icon-xiala"></i><i class="iconfont icon-shangla"></i></a></div>
            </div>
        </div>
        <div class="tableSection">
            <div class="main">
                <div class="searchUnit">
                    <input type="text" placeholder="请输入搜索名称" id="search_media">
                    <a href="javascript:void(0);" class="searchBtn" id="search_btn"></a>
                </div>
                <div>
                    <table id="result" class="result">
                        <thead>
                            <tr role="row">
                                <th class="sorting_disabled" rowspan="1" colspan="1" width="100">logo</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" width="100">资源名称</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" width="100">价格/会员价格</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" width="100">百度权重</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" width="100">收录类型</th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" width="100">链接情况 </th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" width="100">操作</th>
                            </tr>
                        </thead>
                        <tbody id="res-tbody"><tr align="center"><td height="25" colspan="13">加载中...</td></tr></tbody>
                    </table>
                    <div id="pagebox"></div>
                </div>
            </div>
        </div>
    </div>
    @include('home.template.a.footer')
    <script>
        $(document).ready(function () {
            searchMedia(1);
            searchFn();
            $('#filter .filter-item').each(function () {
                var pthis = this;
                $(pthis).find('ul li').on('click',function () {
                    $(pthis).find('ul li').removeClass("active")
                    $(this).addClass("active");
                    $('#pagebox').html('')
                    searchMedia(1);
                })
            })
            $('.filter-item-more').on('click',function(){
                var this_hide = $(this).attr('data-hide');
                $('#filter .filter-item').each(function () {
                    if($(this).attr('data-hide')==1){
                        $(this).attr('data-hide',2)
                    }else if($(this).attr('data-hide')==2){
                        $(this).attr('data-hide',1)
                    }
                })
                if(this_hide==1){
                    $(this).attr('data-hide',2)
                }else{
                    $(this).attr('data-hide',1)
                }
            })
        });
        
        function searchMedia(page){
            var pars = {};
            $('#filter .filter-item').each(function () {
                var key = $(this).find('ul').attr('data-type'),
                        value = $(this).find('ul li.active').attr("data-value");
                pars[key] = value
            })
            pars['page'] = page;
            pars['limit'] = 10;
            pars['title'] =  $('#search_media').val();
            $.ajax({
                url: "{{route('home.sarticle.data')}}",
                type: 'GET',
                data: pars,
                success: function (res) {
                    var data = res&&res.data?res.data:[],html = '';
                    data.forEach(function(el){
                        html += '<tr height="25" align="center">'
                                    +'<td><div style="width: 100%;height:48px;background: url('+ el.logo +') no-repeat center center;background-size: contain;"  border="0" alt="logo"></div></td>'
                                    +'<td><a href="/sarticle/show/'+ el.id +'" target="_blank">'+ el.title +'</a><span style="float:right;width:200px"></span></td>'
                                    +'<td>'+ el.price +'</td>'
                                    +'<td><img src="/template/modules/images/baidu/baidu'+ el.baidu_weight +'.png" /></td>'
                                    +'<td>'+ (el.collect&&el.collect!=null?el.collect.name:'无') +'</td>'
                                    +'<td>'+ {0:'不带链接',1:'可带链接'}[el.accept_link] +'</td>'
                                    +'<td><a class="c-main1" href="/member/login" target="_blank">下单</a></td>'
                                +'</tr>'
                    })
                    html = html || '<tr align="center"><td height="25" colspan="13">暂无数据</td></tr>'
                    $('#res-tbody').html(html)
                    cutPage(Math.ceil(res.total / pars.limit) || 1)
                },
                error: function () {
                    $('#res-tbody').html('<tr align="center"><td height="25" colspan="13">暂无数据</td></tr>')
                    cutPage(1)
                }
            })
        }
        function cutPage(page){
            if($('#pagebox').html()){
                return
            }
            const slp = new SimplePagination(page)
            slp.init({
                container: '#pagebox',
                maxShowBtnCount: 3,
                onPageChange: state => {
                    searchMedia(state.pageNumber)
                }
            })
            // slp.gotoPage(2) 跳转第二页
        } 
        function searchFn(){
            $('#search_btn').on('click',function(){
                $('#pagebox').html('')
                searchMedia(1)
            })
            $('#search_media').bind('keypress',function(event){
                if(event.keyCode == "13"){
                    $('#pagebox').html('')
                    searchMedia(1)
                    return false;
                }
            });
        }
    </script>
</body>
</html>