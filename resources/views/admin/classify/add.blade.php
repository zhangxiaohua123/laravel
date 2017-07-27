<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/amdin/css/pintuer.css">
<link rel="stylesheet" href="/amdin/css/admin.css">
<script src="/amdin/js/jquery.js"></script>
<script src="/amdin/js/pintuer.js"></script>
<!-- 引入富文本编辑器 -->
<script type="text/javascript" charset="utf-8" src="/com/ue/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/com/ue/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/com/ue/lang/zh-cn/zh-cn.js"></script>
<!-- 引入富文本编辑器 -->
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加新闻分类</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="{{action('Admin\ClassifyController@add')}}" enctype="multipart/form-data">
      <div class="form-group">
        <div class="label">
          <label><sapn style="color:red;">*</sapn>分类名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="name" data-validate="required:请输入标签名称" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
          <div class="label">
            <label><sapn style="color:red;">*</sapn>是否推荐：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            <input name="isvouch" type="radio" value="1" checked="checked" />是
            <input name="isvouch" type="radio" value="0" />否 
          </div>
        </div>
      <div class="form-group">
          <div class="label">
            <label><sapn style="color:red;">*</sapn>URL：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            <input name="fl_url" type="text" value="">
          </div>
        </div>
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