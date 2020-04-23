
@section('script')
    <style>
        .layui-upload-box li{
            width: 120px;
            height: 100px;
            float: left;
            position: relative;
            overflow: hidden;
            margin-right: 10px;
            border:1px solid #ddd;
        }
        .layui-upload-box li img{
            width: 100%;
        }
        .layui-upload-box li p{
            width: 100%;
            height: 22px;
            font-size: 12px;
            position: absolute;
            left: 0;
            bottom: 0;
            line-height: 22px;
            text-align: center;
            color: #fff;
            background-color: #333;
            opacity: 0.6;
        }
        .layui-upload-box li i{
            display: block;
            width: 20px;
            height:20px;
            position: absolute;
            text-align: center;
            top: 2px;
            right:2px;
            z-index:999;
            cursor: pointer;
        }
        .layui-layer-msg{
            top:500px!important;
        }
        .isnone{
            display: none;
        }
        .init_show{
            display: block;
        }
        .delete{
            margin-left: 10px;
        }

    </style>
    <script>

        function myurl(obj){
            $(obj).attr('lay-verify','my_url')
        }


        layui.use(['upload','form'],function () {
            var upload = layui.upload
            var form = layui.form
            var max_number = '5';
            @if(session('success'))
            {{--{{ dd(session('success')) }}--}}
            layer.msg('{{session('success')}}',{icon:6});
            {{--{{session('success')}}--}}
            @endif





            $('body').on('click','.delete',function () {
                $(this).closest('.layui-border-box').remove();
                $('#add').removeClass('layui-btn-disabled');
            });




            picupload("#new_upload", "#new-layui-upload-box","new_url")
            function picupload(id, pic, url) {
                upload.render({
                    elem: id
                    , url: '{{ route('uploadImage') }}'
                    , multiple: true
                    ,data:{"_token":"{{ csrf_token() }}"}
                    // ,method:'post'
                    ,before: function(obj){
                        //预读本地文件示例，不支持ie8
                        obj.preview(function(index, file, result){
                            $(pic).html('<li><img src="'+result+'" /><p>上传中</p></li>')
                        });
                    }
                    ,done: function(res){
                        //如果上传失败
                        if(res.code == 0){
                            $(url).val(res.url);
                            $(' '+pic+' li').css('display','block');
                            $(' '+pic+' li p').text('上传成功');
                            return layer.msg(res.msg,{icon:6});
                        }
                        return layer.msg(res.msg,{icon:5});
                    }
                    ,size:1024
                });
            }

            function picOther(index) {

                form.on('radio(new_redirect_type'+index+')',function () {
                    var value=$(this).data('value');

                    console.log(index)

                    if(value==='inside'+index+''){

                        $('.new_mynode'+index+'').show();
                        $('.new_redirect_url'+index+'').hide();

                    }
                    if(value==='outside'+index+''){
                        $('.new_mynode'+index+'').hide();
                        $('.new_redirect_url'+index+'').show();
                        $('.new_product_id'+index+'').hide();
                        $('.new_credit_id'+index+'').hide();
                        $('.new_article_id'+index+'').hide();
                    }
                })
                form.on('radio(new_mynode'+index+')',function () {
                    var value=$(this).data('value');
                    console.log(value)
                    console.log(index)

                    if(value==='product'+index+''){

                        $('.new_product_id'+index+'').show();
                        $('.new_credit_id'+index+'').hide();
                        $('.new_article_id'+index+'').hide();

                    }
                    if(value==='credit'+index+''){
                        $('.new_product_id'+index+'').hide();
                        $('.new_credit_id'+index+'').show();
                        $('.new_article_id'+index+'').hide();

                    }
                    if(value==='article'+index+''){
                        $('.new_product_id'+index+'').hide();
                        $('.new_credit_id'+index+'').hide();
                        $('.new_article_id'+index+'').show();
                    }
                    if(value==='help'+index+''){
                        $('.new_product_id'+index+'').hide();
                        $('.new_credit_id'+index+'').hide();
                        $('.new_article_id'+index+'').hide();

                    }
                    if(value==='about'+index+''){
                        $('.new_product_id'+index+'').hide();
                        $('.new_credit_id'+index+'').hide();
                        $('.new_article_id'+index+'').hide();

                    }
                })
            }



            var index = 0;
            var type = '';

            window.Add = function () {
                var now_number = $('#myform').find('.layui-border-box').length
                if(now_number>=max_number){
                    $('#add').addClass('layui-btn-disabled');
                    layer.msg('已达上限，请先移出无用banner',{icon:5});
                    return false;
                }

                var recoder = '<div class="layui-border-box " style="border:1px solid green; margin-top: 20px;padding: 20px 0px 20px 0px;">'+
                    '<div class="layui-form-item">'+
                    '<div class="layui-input-block">'+
                    '<div class="layui-upload">'+
                    '<button type="button" class="layui-btn" id="new_upload'+index+'"><i class="layui-icon">&#xe67c;</i>图片上传</button>'+
                    '<span><a class="layui-btn layui-btn-danger delete" href="javascript:;"   id="delete">移除</a></span>'+
                    '<div class="layui-upload-list" >'+
                    '<ul id="new-layui-upload-box'+index+'" class="layui-clear image-style layui-upload-box">'+

                    '<li style="display: none"><img class="images" src="" /><p>待上传</p></li>'+
                    '</ul>'+
                    '<input type="hidden" name="url[]"  lay-verify="my_pic" id="new_url'+index+'" value="" class="my_pic">'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>' +
                    '</div>' +
                    '</div>';

                // recoder.find(".layui-btn").attr("id", "new_upload" + index + "");
                // recoder.find(".layui-upload-list").attr("id", "new-layui-upload-box" + index + "");
                // recoder.find(".layui-upload-list").empty();
                $(".mytable").append(recoder);

                picupload("#new_upload" + index + "", "#new-layui-upload-box" + index + "", "#new_url"+index+"")
                picOther(index)

                index++;
                form.render();

            }
            form.render();



        });
    </script>
@endsection