<div class="form-group">
<div class="label">
<label><sapn style="color:red;">*</sapn>内容：</label>
</div>
<div class="field">
<textarea name="content"  id="myueditor" placeholder="请输入博主简介" class="input"  style="height:450px; border:1px solid #ddd;" data-validate="required:请输入问答内容"> {{$blogger->content}}</textarea>
<div class="tips"></div>
</div>
</div>
<div class="form-group">
<div class="label">
<label><sapn style="color:red;">*</sapn>关键字：</label>
</div>
<div class="field">
<input type="text" class="input" name="keywords" value="{{$blogger->keywords}}"  data-validate="required:请输入关键字"/>
</div>
</div>
<div class="form-group">
<div class="label">
<label><sapn style="color:red;">*</sapn>关键字描述：</label>
</div>
<div class="field">
<textarea type="text" class="input" name="description" style="height:80px;" data-validate="required:请输入关键字描述" >{{$blogger->description}}</textarea>
</div>
</div>