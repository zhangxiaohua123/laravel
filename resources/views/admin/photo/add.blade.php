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
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加相册</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="{{action('Admin\PhotoController@add')}}" enctype="multipart/form-data">
      <div class="form-group">
        <div class="label">
          <label><sapn style="color:red;">*</sapn>标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="" name="title" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label><sapn style="color:red;">*</sapn>添加图片：</label>
        </div>
        <div class="field">
          <ul class="forminfo">
                <li>
                    <label>相册图片[<a href="javascript:;" class="add">+</a>]</label>
                    <input name="img[]" type="file" />
                </li>
            </ul>
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
          <label><sapn style="color:red;">*</sapn>关键字：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="keywords" value=""  data-validate="required:请输入关键字"/>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label><sapn style="color:red;">*</sapn>关键字描述：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input" name="description" style="height:80px;" data-validate="required:请输入关键字描述" ></textarea>
        </div>
      </div>
      <div class="form-group">
          <div class="label">
            <label><sapn style="color:red;">*</sapn>URL：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            <input name="xc_url" type="text" value="">
          </div>
        </div>
      <div class="form-group">
        <div class="label">
          <label>点击次数：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="hits" value=""   />
          <div class="tips"></div>
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

//相册上传
$(function(){
    // $('#btnSubmit').on('click',function(){
    //     $('form').submit();
    // });

    //给+号绑定点击事件
    $('.add').click(function(){
        //事件的处理程序
        var li = "<li><label>相册图片[<a href='javascript:;' class='del'>-</a>]</label><input name='img[]' type='file' /></li>";
        //内容追加
        $(this).parent().parent().after(li);
    });

    //给-号绑定点击事件
    $(document).on('click','.del',function(){
        //事件处理程序
        $(this).parent().parent().remove();
    });
    //给删除图片的-号 绑定点击事件
    $('.delpic').click(function(){
        //复制this
        var _this = this;
        //移除页面上的图片
        $(_this).parent().remove();
    });
});
</script>