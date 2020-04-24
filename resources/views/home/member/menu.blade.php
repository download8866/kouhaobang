<style>
    .menu {width:200px;background:#fff;border-radius:4px;}
    .menu .active {color: #4eb6ff!important;}
    .menu .submenu .submenu-title{height: 52px; line-height: 52px;padding:0 20px;display:block;border-bottom: 1px solid #f5f5f5;}
    .menu .submenu .submenu-title i{transition: transform 0.4s;float:right;}
    .menu .submenu .submenu-title.on i{transform: rotate(180deg);}
    .submenu-item {background:#f7fafb;max-height:0;overflow:hidden;
        -webkit-transition: max-height .4s ease-in;
        -moz-transition: max-height .4s ease-in;
        -o-transition: max-height .4s ease-in;
        transition: max-height .4s ease;}
    .submenu-item .item {padding-left: 40px;height: 52px;line-height: 52px;display:block;border-bottom: 1px solid #f5f5f5;font-size: 14px; color: #666;position: relative;}
    .menu .submenu .submenu-title:hover, .submenu-item .item:hover{background: #eff3f8;}
    .sarticle-cart{color: #fff; position:relative; top:-10px;left:-5px;background: #ff6900;padding:0 4px;border-radius:100px;font-size:12px;}
</style>

<div class="menu">
    <div class="submenu">
        <a href="/member" class="submenu-title @if( $menu == 'member' ) active @endif">概览</a>
    </div>
    <div class="submenu open">
        <a href="javascript:;" class="submenu-title">我的订单<i class="iconfont icon-xiala"></i></a>
        <div class="submenu-item">
            @if(strstr($my_apply, 'sarticle'))
            <a class="item @if( $menu == 'sarticle_order' ) active @endif" href="/member/sarticle/order">软文订单</a>
            @endif
        </div>
    </div>
    <div class="submenu open">
        <a href="javascript:;" class="submenu-title">购物车<i class="iconfont icon-xiala"></i></a>
        <div class="submenu-item">
            @if( isset($my_apply) &&  strstr($my_apply, 'sarticle'))
            <a class="item @if( $menu == 'sarticle_cart' ) active @endif" href="/member/sarticle/cart">软文
                <em class="sarticle-cart" style="display:none;">0</em>
            </a>
            @endif
        </div>
    </div>
    <div class="submenu open">
        <a href="javascript:;" class="submenu-title">财务管理<i class="iconfont icon-xiala"></i></a>
        <div class="submenu-item">
            <a class="item  @if( $menu == 'finance' ) active @endif" href="/member/finance">财务列表</a>
            <a class="item @if( $menu == 'pay' ) active @endif" href="/member/finance/pay">个人充值</a>
        </div>
    </div>
    <div class="submenu open">
        <a href="javascript:;" class="submenu-title">账号管理<i class="iconfont icon-xiala"></i></a>
        <div class="submenu-item">
            <a class="item  @if( $menu == 'basic' ) active @endif" href="/member/basic">基本信息</a>
        </div>
    </div>
   
    <div class="submenu open">
        <a href="javascript:;" class="submenu-title">文章管理<i class="iconfont icon-xiala"></i></a>
        <div class="submenu-item">
            @if(strlen($my_apply) > 0)
            <a class="item @if( $menu == 'active_create' ) active @endif" href="/member/active/create">文章发布</a>
            <a class="item @if( $menu == 'active' ) active @endif" href="/member/active">文章列表</a>
            @endif
        </div>
    </div>
</div>
<script>
    $(function() {
        getCart()
        $('.menu .submenu').each(function() {
            var len = $(this).find('.submenu-item .item').length, othis = this, is_ac = false;
            $(othis).find('.submenu-item a').each(function(){
                if($(this).hasClass('active')){ is_ac = true; }
            })
            // if($(othis).hasClass('open') && is_ac){
            //     $(othis).find('.submenu-title').addClass('on').next('.submenu-item').css('max-height',len*53+'px')
            // }
            if($(othis).hasClass('open') ){
                $(othis).find('.submenu-title').addClass('on').next('.submenu-item').css('max-height',len*53+'px')
            }
            $(othis).find('.submenu-title').on('click', function() {
                var h = $(othis).find('.submenu-item').height();
                if (h==0) {
                    $(this).addClass('on').next().css('max-height',len*53+'px')
                } else {
                    $(this).removeClass('on').next().css('max-height','0px')
                }
            })
        })
    })
    function getCart() {
        $.ajax({
            url: "{{route('home.member.sarticle.cart.data')}}",
            type: 'GET',
            data: {},
            success: function (res) {
                if(res.total>0){
                    $('.sarticle-cart').show().html(res.total)
                }
            },
            error: function () { }
        })
    }
</script>