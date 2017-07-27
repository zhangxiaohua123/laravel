<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassifyController extends Controller {
	public function  show_list(){
		$fllist=DB::table('blog_classify')->orderBy('id',' desc ')->paginate(2);
		$page=$fllist->links();
		return view('admin.classify.show_list',['fllist'=>$fllist,'page'=>$page]);
	}
	public function add(Request $request){
		if($request->isMethod('POST')){
			$data=$request->all();
			$data['add_time']=$data['upd_time']=time();
			$data['fl_url']=$data['fl_url'].mt_rand(1000,9999);
			$result=DB::table('blog_classify')->insert($data);
			if($result){
                return   redirect('admin/classify')->with('success','添加成功！');
			}else{
                return   redirect()->back();
			}
		}else{
			return view('admin.classify.add');
		}
	}
	public function del(Request $request){
		$id=$request->input('id');
		$result=DB::table('blog_classify')->where('id',$id)->delete();
		if($result){
			return '删除成功';
		}else{
			return '删除失败';
		}
	}
	public function edit(Request $request){
		if($request->isMethod('POST')){
			$data=$request->all();
			$data['upd_time']=time();
			$data['fl_url']=$data['fl_url'].mt_rand(1000,9999);
			$result=Db::table('blog_classify')->where('id',$data['id'])->update($data);
			if($result){
                return   redirect('admin/classify')->with('success','添加成功！');
			}else{
                return   redirect()->back();
			}
		}else{
		    $id=$request->input('id');
			$fllist=DB::table('blog_classify')->where('id',$id)->first();
            return view('admin.classify.edit',['fllist'=>$fllist]);
		}
	}
	
	

}