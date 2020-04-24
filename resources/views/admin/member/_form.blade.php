{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">登录名</label>
    <div class="layui-input-inline">
        <input type="text" name="name" value="{{ $member->name ?? old('name') }}"  onKeyUp="value=value.replace(/[\W]/g,'')" lay-verify="required" placeholder="请输入登录名" class="layui-input" >
    </div>
    <span>只能填写英文和数字</span>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">手机号</label>
    <div class="layui-input-inline">
        <input type="text" name="phone" value="{{$member->phone??old('phone')}}" required="phone" lay-verify="phone" placeholder="请输入手机号" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">密码</label>
    <div class="layui-input-inline">
        <input type="password" name="password" placeholder="请输入密码" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">确认密码</label>
    <div class="layui-input-inline">
        <input type="password" name="password_confirmation" placeholder="请输入密码" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">用户姓名</label>
    <div class="layui-input-inline">
        <input type="text" name="username" value="{{$member->username??old('username')}}"  placeholder="请输入姓名" class="layui-input">
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">联系手机</label>
    <div class="layui-input-inline">
        <input type="text" name="mobile" value="{{$member->mobile??old('mobile')}}"  placeholder="请输入联系手机" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">qq</label>
    <div class="layui-input-inline">
        <input type="text" name="qq" value="{{$member->qq??old('qq')}}"  placeholder="请输入qq" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">公司</label>
    <div class="layui-input-inline">
        <input type="text" name="company" value="{{$member->company??old('company')}}"  placeholder="请输入公司" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">描述</label>
    <div class="layui-input-inline">
        <input type="text" name="mark" value="{{$member->mark??old('mark')}}" placeholder="请输入描述" class="layui-input">
    </div>
    <span>仅后台可看</span>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">头像</label>
    <div class="layui-input-block">
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="uploadPic"><i class="layui-icon">&#xe67c;</i>图片上传</button>
            <div class="layui-upload-list" >
                <ul id="layui-upload-box" class="layui-clear">
                    @if(isset($member->avatar))
                        <li><img src="{{ $member->avatar }}" /><p>上传成功</p></li>
                    @endif
                </ul>
                <input type="hidden" name="avatar" id="avatar" value="{{ $member->avatar??'' }}">
            </div>
        </div>
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.member')}}" >返 回</a>
    </div>
</div>