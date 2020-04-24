<div class="wrap tx-c c-999 fz12 mt40 pb20">
    <p class="f">
        <a href="/" target="_blank" class="c-999 plr10">首页</a>
        <a href="/about/us" target="_blank" class="c-999 plr10">关于我们</a> 
        <a href="javascript:;" class="c-999 service-btn plr10">服务条款</a> 
        <em> <span style="padding: 10px">联系方式：{{$website->phone}}</span> </em>
    </p>
    <p class="fz14 mt20 "><em>© {{$website->company}} 版权所有  </em><em> {{$website->record_num}}</em></p>
</div>
<div id="service-box" style="display:none;position:fixed;top:0;right:0;left:0;bottom:0; z-index:99999;background:rgba(0, 0, 0, 0.5)">
        <div style="
            background:#fff;
            font-size: 16px;
            width: 600px;
            border-radius: 2px;
            position: absolute;
            padding:26px 16px;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            -webkit-transform: translate(-50%,-50%);
            -o-transform: translate(-50%,-50%);
            -moz-transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);">
            <div style="padding:10px;">
                    <p style="text-align:center;font-size: 20px;font-weight: bold;margin-bottom: 20px;">服务条款</p>
                    <div class="service-content" style=" width: 100%;overflow: auto;height:400px;">
                    </div>
                </div>
            <img class="ysgb" onClick="$(this).parents('#service-box').hide()" style="width:16px;position:absolute;right:10px;top:10px;cursor:pointer;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAABhElEQVQ4T62Vu07DMBSGf6t5ApgQ8AYssLBWsqsgJi47F4k3YAREETDyBkhcdgoLiKjHUlcWuvAG3CZ4AldGJ3IiNzgNLbXUKvLx/8U3fREoaVLKFSHEHIB5AItu2BOArrX2RWt9F4qKYme9Xp+JougcQFz2MtefGGN2Op3Omz+uD6iU2gBwVQEqljeJ6DrrzIGNRkNaa2lIWDpcCKHa7bZOn/kvjuOJXq/3NQosy9RqtckkSb5ToJTyQgix9R+gtfZSa70tlFJrAG6KMCLi2iGAZqHWJKIjpZQNTGCdQycA9gLFLOhDQ31+9JSB9wCWS5brA+BmFpp1Fn9g4AeAqQH7l0K5XrIFfvSTgXwxp8cEfGcgHwgfTKgNu+QWA/cBHI/pUA6Ek8DtOK6NtXY1vdhKqcc/yKDq3idEtJQCnWFeqxKD6saYWTZPLocRTZO9IzdOn75GMY5vmtw2/lLYPMaYsypZsAyiKNplw/j5X8bOik4aC+4TwJ8Bbl33eyaiVmhPfwDZP7VATq64sQAAAABJRU5ErkJggg==" alt="">
        </div>
    </div>
<script>
    $(function(){
        $('.service-btn').on('click',function(){
            $.ajax({
                url: "{{route('home.get.server.clause')}}",
                type: 'POST',
                data: {'_token':'{{csrf_token()}}'},
                success: function (res) {
                $('#service-box').show().find('.service-content').html(res.data.content)
                },
                error: function () {
                
                }
            })
        })
    })
</script>