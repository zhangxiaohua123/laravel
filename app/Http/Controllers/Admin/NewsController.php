<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\News;
use Illuminate\Http\Request;

class NewsController  extends Controller {
	public function  show_list(){
       $news= News::select(2);
       $page =$news->links();
        return view('admin.news.show_list',['news'=>$news,'page'=>$page]);
	}
	public function add(Request $request){
		if($request->isMethod('POST')){
			$data=$request->all();
			$data['add_time']=$data['upd_time']=time();
			//摘要的截取
			$temple=strip_tags($data['content']);
			$temple=str_replace('&nbsp;', '  ', $temple);
			$data['abstract']=mb_substr($temple,0,120,'utf-8').'...';
			//对自定义链接进行重新拼接
			$data['xw_url']=$data['xw_url'].mt_rand(1000,9999);                       
			$result=News::saveNews($data);
			if($result){
                return   redirect('admin/news')->with('success','添加成功！');
			}else{
                return   redirect()->back();
			}
		}else{
			return $this->fetch();
		}
	}
	public function get_content(Request $request){
        $id = $request->input('id');
        $data =News::findNews($id);
        // 将html实体转回标签
        $data['content'] = htmlspecialchars_decode($data['content']);
        return response()->json($data);
    }

    public function del(Request $request){
		$id=$request->input('id');
		$result=News::delNews($id);
		if($result){
			return '删除成功';
		}else{
			return '删除失败';
		}
	}
	public function edit(Request $request){
		if($request->isMethod('POST')){
			$data=$request->all();
			// dump($data);exit;
			$data['upd_time']=time();
		    //摘要的截取
			$temple=strip_tags($data['content']);
			$temple=str_replace('&nbsp;', '  ', $temple);
			$data['abstract']=mb_substr($temple,0,90,'utf-8').'...';
			//对自定义链接进行重新拼接
			$data['xw_url']=$data['xw_url'].mt_rand(1000,9999);
			$result=$model->editNews($data);
			if($result){
				$this->success('修改成功','img/News/show_list');
			}else{
				$this->error('修改失败');
			}
		}else{
			$xwlist=$model->findNews($id);
			$this->assign('xwlist',$xwlist);
			$fl=$model->selectfl();
			$this->assign('fl',$fl);
			return $this->fetch();
		}
	}
}




