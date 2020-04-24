{{csrf_field()}}
<div class="layui-form-item">
    <label for="" class="layui-form-label">标题</label>
    <div class="layui-input-block">
        <input type="text" name="title" value="{{$article->title??old('title')}}" lay-verify="required" placeholder="请输入标题" class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">分类</label>
    <div class="layui-input-inline">
        <select name="category_id" lay-verify="required">
            <option value=""></option>
            @foreach($categorys as $category)
                <option value="{{ $category->id }}" @if(isset($article->category_id)&&$article->category_id==$category->id)selected @endif >{{ $category->name }}</option>
                @if(isset($category->allChilds)&&!$category->allChilds->isEmpty())
                    @foreach($category->allChilds as $child)
                        <option value="{{ $child->id }}" @if(isset($article->category_id)&&$article->category_id==$child->id)selected @endif >&nbsp;&nbsp;&nbsp;┗━━{{ $child->name }}</option>
                        @if(isset($child->allChilds)&&!$child->allChilds->isEmpty())
                            @foreach($child->allChilds as $third)
                                <option value="{{ $third->id }}" @if(isset($article->category_id)&&$article->category_id==$third->id)selected @endif >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;┗━━{{ $third->name }}</option>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        </select>
    </div>
</div>
<div class="layui-form-item">
    <label for="" class="layui-form-label">SEO关键词</label>
    <div class="layui-input-block">
        <input type="text" name="keywords" value="{{$article->keywords??old('keywords')}}" lay-verify="required" placeholder="请输入关键词" class="layui-input" >
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">描述</label>
    <div class="layui-input-block">
        <textarea name="description" placeholder="请输入描述" class="layui-textarea">{{$article->description??old('description')}}</textarea>
    </div>
</div>

<div class="layui-form-item">
    <label for="" class="layui-form-label">阅读数</label>
    <div class="layui-input-block">
        <input type="number" name="click" value="{{$article->click??mt_rand(100,500)}}" lay-verify="required|numeric"  class="layui-input" >
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">状态</label>
    <div class="layui-input-block">
        <input type="checkbox"  name="status" lay-skin="switch" lay-filter="switchTest" lay-text="上架|下架" @if(isset($article) && $article->status === 1) checked @endif><div class="layui-unselect layui-form-switch" lay-skin="_switch"><em>下架</em><i></i></div>
    </div>
</div>
@include('UEditor::head');
<div class="layui-form-item">
    <label for="" class="layui-form-label">内容</label>
    <div class="layui-input-block">
        <script id="container" name="content" type="text/plain">
            {!! $article->content??old('content') !!}
        </script>
    </div>
</div>


<div class="layui-form-item">
    <div class="layui-input-block">
        <button type="submit" class="layui-btn" lay-submit="" lay-filter="formDemo">确 认</button>
        <a  class="layui-btn" href="{{route('admin.article')}}" >返 回</a>
    </div>
</div>

