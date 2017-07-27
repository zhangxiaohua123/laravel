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
    <!-- <script src="/admin/js/jquery.js"></script> -->
    <script src="/admin/js/pintuer.js"></script>
    <script src="/com/iDialog/jquery-1.8.3.min.js"></script>
    <script src="/com/iDialog/jquery.iDialog.js" dialog-theme="default"></script>
</head>
<body>
@include('admin.com')
<form method="post" action="">
  <div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder">相册管理</strong></div>
    <div class="padding border-bottom">
      <ul class="search">
        <li>
          <button type="button"  class="button border-green" id="checkall"><span class="icon-check"></span> 全选</button>
          <button type="button" class="button border-green" id="add">添加</button>
        </li>
      </ul>
    </div>
    <script>
      $('#add').click(function(){
        window.location.href="{{action('Admin\PhotoController@add')}}";
      })  
    </script>
    <table class="table table-hover text-center">
      <tr>
        <th width="120">ID</th>
        <th>标题</th>       
        <!-- <th>相册图集</th> -->
        <th>添加时间</th>
        <th>点击量</th>
        <th>是否推荐</th>
        <th>自定义URL</th>
        <th>操作</th>       
      </tr>
      @foreach($photo as $vo)
        <tr>
          <td><input type="checkbox" name="id[]" value="1" />
            {{$vo->id}}</td>
          <td>{{$vo->title}}</td>
          <!-- <td>
          {volist name="$vo.img" id="vol"}
          <img style="width:50px;height:50px;" src="{$vol}" />
          {/volist}
          </td> -->
          <td>{{date('Y-m-d',$vo->add_time)}}</td>
          <td>{{$vo->hits}}</td>
          <td>
            @if($vo->isvouch == 0)
              不推荐
            @else
              推荐
            @endif
          </td>
          <td>{{$vo->xc_url}}</td>
          <td><div class="button-group"> <a class="button border-red" href="javascript:void(0)" onclick="return del({{$vo->id}})"><span class="icon-trash-o"></span> 删除</a> </div>
          <div class="button-group"> <a class="button border-red" href="{{action('Admin\PhotoController@edit','id='.$vo->id)}}"><span class="icon-trash-o"></span>修改</a>
          </td>
        </tr>
     @endforeach
      <tr>
        <td colspan="13">
        <div class="pagelist"> 
        {{$page}}
        </div>
        </td>
      </tr>
    </table>
  </div>
</form>
<script type="text/javascript">

function del(id){
	if(confirm("您确定要删除吗?")){
		$.post("{{action('Admin\PhotoController@del')}}",{'id':id},function(msg){
       alert(msg);
       location.reload();
     })
	}
}

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

function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false; 		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}
// //查看全文
// function show(id){
//   //调用$.post方法请求后台php程序
//   $.post("/index.php/img/News/get_content", {'id':id}, function(msg){
//     // alert(msg);
//     // 接收后台返回的数据后，调用iDialog进行显示
//     iDialog({
//         title:msg.title,
//         content:msg.content,
//         lock: true,
//         width:800,
//         fixed: true,
//         height:500
//     });
//   }, 'json');
// }
</script>
</body></html>