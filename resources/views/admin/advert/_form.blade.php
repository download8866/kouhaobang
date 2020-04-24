<div class="layui-card">
    <div class="layui-card-header layuiadmin-card-header-auto">
        <div class="layui-btn-group">
            <div class="layui-card-header layuiadmin-card-header-auto">
                <h2>营销位配置 -
                    <span >{{$data->position->name}}</span>
                </h2>
            </div>
        </div>
    </div>
    <div class="layui-card-body">
            @if($data->position->id == 1)
                <p style="color:red;">请上传1M以内的png、jpg格式的图片 (建议尺寸 ：1920*500。)</p>
            @elseif($data->position->id == 2)
                <p style="color:red;">请上传1M以内的png、jpg格式的图片 (建议尺寸 ：1920*500。)</p>
            @elseif($data->position->id == 3)
                <p style="color:red;">请上传1M以内的png、jpg格式的图片 (建议尺寸 ：1920*500。)</p>
            @else
                <p style="color:red;">请上传1M以内的png、jpg格式的图片 (建议尺寸 ：480*180。)</p>
            @endif


            {{csrf_field()}}
            {{method_field('put')}}
            <div class="mytable">
                @if($data->thumb)
                    @foreach($data->thumbs as $k=>$item)
                        <div class="layui-border-box " style="border:1px solid green; margin-top: 20px;padding: 20px 0px 20px 0px;">
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <div class="layui-upload">
                                        <button type="button" class="layui-btn" id="upload{{ $k }}"><i class="layui-icon">&#xe67c;</i>图片上传</button>
                                        <span><a class="layui-btn layui-btn-danger delete" href="javascript:;"  onclick="_del({{$k}})" >移除</a></span>
                                        <div class="layui-upload-list" >
                                            <ul id="layui-upload-box{{ $k }}" class="layui-clear image-style layui-upload-box">
                                                @if($item)
                                                    <li><img src="{{ $item}}" /><p>上传成功</p></li>
                                                @endif
                                            </ul>
                                            <input type="hidden" class="my_pic" name="url[]" lay-verify="my_pic" id="url{{ $k }}" value="{{ $item??'' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="layui-form-item" style="margin-top: 20px">
                <div class="layui-input-block">
                    <button type="button" class="layui-btn" id="add" onclick="Add()">+添 加</button>
                    <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
                    <a  class="layui-btn layui-btn-primary" href="/admin/advert" >返 回</a>
                </div>
            </div>
    </div>
</div>

