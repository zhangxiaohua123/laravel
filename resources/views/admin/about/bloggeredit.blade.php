<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/admin/css/pintuer.css">
<link rel="stylesheet" href="/admin/css/admin.css">
<script src="/admin/js/jquery.js"></script>
<script src="/admin/js/pintuer.js"></script>
<!-- 引入富文本编辑器 -->
<script type="text/javascript" charset="utf-8" src="/com/ue/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/com/ue/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/com/ue/lang/zh-cn/zh-cn.js"></script>
<!-- 引入富文本编辑器 -->
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改博主简介</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="{{action('Admin\AboutController@bloggeredit')}}" enctype="multipart/form-data">
    <input type="hidden" name='id' value="{{$blogger->id}}" />
      @include('admin.about.form')
      {{--<div class="form-group">--}}
        {{--<div class="label">--}}
          {{--<label><sapn style="color:red;">*</sapn>内容：</label>--}}
        {{--</div>--}}
        {{--<div class="field">--}}
          {{--<textarea name="content"  id="myueditor" placeholder="请输入博主简介" class="input"  style="height:450px; border:1px solid #ddd;" data-validate="required:请输入问答内容">{$blogger.content}</textarea>--}}
          {{--<div class="tips"></div>--}}
        {{--</div>--}}
      {{--</div>--}}
      {{--<div class="form-group">--}}
        {{--<div class="label">--}}
          {{--<label><sapn style="color:red;">*</sapn>关键字：</label>--}}
        {{--</div>--}}
        {{--<div class="field">--}}
          {{--<input type="text" class="input" name="keywords" value="{$blogger.keywords}"  data-validate="required:请输入关键字"/>--}}
        {{--</div>--}}
      {{--</div>--}}
      {{--<div class="form-group">--}}
        {{--<div class="label">--}}
          {{--<label><sapn style="color:red;">*</sapn>关键字描述：</label>--}}
        {{--</div>--}}
        {{--<div class="field">--}}
          {{--<textarea type="text" class="input" name="description" style="height:80px;" data-validate="required:请输入关键字描述" >{$blogger.description}</textarea>--}}
        {{--</div>--}}
      {{--</div>--}}
      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>
<script type="text/javascript">
    //实例化编辑器
    var ue = UE.getEditor('myueditor');
</script>