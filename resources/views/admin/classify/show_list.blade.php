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
    <!-- <script src="/static/com/iDialog/jquery-1.8.3.min.js"></script>
    <script src="/static/com/iDialog/jquery.iDialog.js" dialog-theme="default"></script> -->  
</head>
<body>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 分类管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button" class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="button" class="button border-green" id="add">添加</button>
        </li>
      </ul>
    </div>
    <script>
      $('#add').click(function(){
        window.location.href="{{action('Admin\ClassifyController@add')}}";
      })  
    </script>
    <table class="table table-hover text-center">
      <tr>
        <th width="10">ID</th>
        <th>分类名称</th> 
        <th>自定义url</th> 
        <th>添加时间</th>
        <th>修改时间</th>
        <th>操作</th>       
      </tr>  
      @foreach( $fllist  as $vo)
        <tr>
          <td><input type="checkbox" name="id[]" value="{{$vo->id}}" />{{$vo->id}}</td>
          <td>{{$vo->name}}</td>
          <td>{{$vo->fl_url}}</td>
          <td>{{date('Y-m-d',$vo->add_time)}}</td>
          <td>{{date('Y-m-d',$vo->upd_time)}}</td>
          <td>
          <div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="return del({{$vo->id}})"><span class="icon-trash-o"></span> 删除</a> </div>
          <div class="button-group"> <a class="button border-red" href="{{action('Admin\ClassifyController@edit','id='.$vo->id)}}"><span class="icon-trash-o"></span>修改</a></div>
          </td>
        </tr>
      @endforeach
      <tr>
        <td colspan="11">
        <div class="pagelist"> 
        {{$page}}
        </div>
        </td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
    if (this.checked) {
      this.checked = false;
    }
    else {
      this.checked = true;
    }
  });
})

function del(id){
	if(confirm("您确定要删除吗?")){
		 $.post("{{action('Admin\ClassifyController@del')}}",{'id':id},function(msg){
       alert(msg);
       location.reload();
     })
	}
}
function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if(Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false){
      return false;
    }else{
      var list = $(':checkbox:checked');
      var str = "";
      list.each(function(){
        str += $(this).val() + ',';
      })
      str = str.substr(0, str.length - 1);
      // alert(str);
      $.post("{:url('img/Label/dels')}",{'id':str},function(msg){
       alert(str);
       location.reload();
     });
    }  		
	}else{
		alert("请选择您要删除的内容!");
		return false;
  }
}
</script>
</body></html>