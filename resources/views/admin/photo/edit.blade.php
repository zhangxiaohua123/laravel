<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/static/img/css/pintuer.css">
<link rel="stylesheet" href="/static/img/css/admin.css">
<script src="/static/img/js/jquery.js"></script>
<script src="/static/img/js/pintuer.js"></script>
<!-- 引入富文本编辑器 -->
<script type="text/javascript" charset="utf-8" src="/static/com/ue/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/static/com/ue/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/static/com/ue/lang/zh-cn/zh-cn.js"></script>
<!-- 引入富文本编辑器 -->
</head>
<body>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改相册</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="{:url('edit')}" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{$xclist.id}">  
      <div class="form-group">
        <div class="label">
          <label><sapn style="color:red;">*</sapn>标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="{$xclist.title}" name="title" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label><sapn style="color:red;">*</sapn>修改图片：</label>
        </div>
        <div class="field">
          <ul class="forminfo">
                <li>
                    <label>相册图片[<a href="javascript:;" class="add">+</a>]</label>
                    <input name="img[]" type="file" />
                </li>
              {foreach name="$xclist.img" key="k" item="vol"}
              <img style="width:50px;height:50px;" id="img{$k}" onclick="edit({$xclist.id},{$k})" src="{$vol}" />
              {/foreach}
            </ul>
          <div class="tips"></div>
        </div>
      </div>
        <div class="form-group">
          <div class="label">
            <label><sapn style="color:red;">*</sapn>是否推荐：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            <input name="isvouch" type="radio" value="1" 
            {if condition=" $xclist.isvouch ==  1 "}
              checked="checked"
            {else /}  
            {/if}
             />是
            <input name="isvouch" type="radio" value="0" 
            {if condition=" $xclist.isvouch ==  0 "}
              checked="checked"
            {else /}  
            {/if}
             />否 
          </div>
        </div>
      <div class="form-group">
        <div class="label">
          <label><sapn style="color:red;">*</sapn>关键字：</label>
        </div>
        <div class="field">
          <input type="text" class="input" name="keywords" value="{$xclist.keywords}"  data-validate="required:请输入关键字"/>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label><sapn style="color:red;">*</sapn>关键字描述：</label>
        </div>
        <div class="field">
          <textarea type="text" class="input" name="description" style="height:80px;" data-validate="required:请输入关键字描述" >{$xclist.description}</textarea>
        </div>
      </div>
      <div class="form-group">
          <div class="label">
            <label><sapn style="color:red;">*</sapn>URL：</label>
          </div>
          <div class="field" style="padding-top:8px;"> 
            <input name="xc_url" type="text" value="{$xclist.xc_url}">
          </div>
        </div>
      <div class="form-group">
        <div class="label">
          <label>点击次数：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="hits" value="{$xclist.hits}"   />
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

function edit(id,img){
      // $('#img'+img).remove();
      if(window.confirm('确定要删除吗？')){
        $.post("{:url('img/Photo/delpic')}",{'id':id,'img':img},function(msg){
          alert(msg);
          $('#img'+img).remove();
        });
      }
    }
</script>