<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Admin\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AboutController extends Controller {
	//博主简介
	public function blogger(){
        $bloggerlist=Blog::selectblog(2);
		$page = $bloggerlist->links();
        return  view('admin.about.blogger',['bloggerlist'=>$bloggerlist,'page'=>$page]);
	}
	public function bloggeradd(Request  $request){
		if($request->isMethod('POST')){
		    //对数据字段进行验证
//            $this->Validate($request, [
//                'content' => 'required|unique:posts',
//                'keywords' => 'required|max:255|min:2',
//                'description' => 'required',
//            ]);
			$data=$request->all();
			dump($data);exit;
			$data['add_time']=$data['upd_time']=time();
            $result=Blog::saveblog($data);
			if($result){
			    return redirect('blogger')->withErrors('添加成功');
//			    return Redirect::to('blogger')->withErrors('添加成功');
			}else{
                return  redirect('bloggeradd')->withErrors('添加失败');
			}
		}else{ 
			return view('admin.about.bloggeradd');
		}
		
	}
	public function bloggerget_content(Request  $request){
      $id = $request->input('id');
      $data =Blog::findblog($id);
        // 将html实体转回标签
        $data->content= htmlspecialchars_decode($data->content);
        return  response()->json($data);
    }

    public function bloggerdel(Request $request){
		$id=$request->input('id');
		if(Blog::delblog($id)){
			return '删除成功';
		}else{
			return '删除失败';
		}
	}
	public function bloggeredit(Request $request){
        echo  1;
		if( $request->isMethod('POST')){
			$data=$request->all();
			$data['upd_time']=time();
			$result=Blog::updateblog($data);
			if($result){
                return redirect('blogger')->withErrors('更新成功');
			}else{
                return redirect('blogger')->withErrors('更新失败');
			}
		}else{
		    $id=$request->input('id');
			$blogger=Blog::findblog($id);
			return view('admin.about.bloggeredit',['blogger'=>$blogger]);
		}
		
	}

}