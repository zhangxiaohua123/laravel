<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller {
	public function  show_list(){
		$photo=Photo::selectPhoto(2);
		foreach($photo as &$vo){
			$vo->img=explode(',',$vo->img);
		}
		$page =$photo->links();
		return view('admin.photo.show_list',['photo'=>$photo,'page'=>$page]);
	}

	//相册方法
	public function add(Request $request){
		//判断请求类型
		if($request->isMethod('POST')){
			$data=$request->all();
			$data['add_time']=$data['upd_time']=time();
			//对自定义链接进行重新拼接
			$data['xc_url']=$data['xc_url'].mt_rand(1000,9999);
			 // 获取表单上传文件
		    $files =$request->file('img');
		    $data['img']=array();
		    foreach($files as $k=>$file){
                $allowed_extensions = ["png", "jpg", "gif"];
                if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                    return ['error' => 'You may only upload png, jpg or gif.'];
                }
                $destinationPath = 'uploads/'.date('Ymd',time()); //public 文件夹下面建 /uploads 文件夹
                $extension = $file->getClientOriginalExtension();
                $fileName = str_random(10).'.'.$extension;
                $file->move($destinationPath, $fileName);
//                $filePath = asset($destinationPath.$fileName);
                $filePath =$destinationPath.$fileName;
                $data['img'][$k]=$filePath;
    		}
    		$data['img']=implode(',',$data['img']);
//    		dump($data['img']);exit;
            //获取表单上传图片
			$result=Photo::savePhoto($data);
			if($result){
				return  redirect('admin/photo')->withErrors('添加成功！');
			}else{
                return  redirect('admin/photo')->withErrors('添加失败！');
			}
		}else{
			return view('admin.photo.add');
		}
	}
    public function del(Request $request){
		$id=Request::instance()->post('id');
		$model=new xc;
		if($model->delPhoto($id)){
			return '删除成功';
		}else{
			return '删除失败';
		}
	}
	public function edit($id){
		$model=new xc;
		if(Request::instance()->isPost()){
			$data=Request::instance()->post();
			// dump($data);exit;
			$data['upd_time']=time();
			//对自定义链接进行重新拼接
			$data['xc_url']=$data['xc_url'].mt_rand(1000,9999);
			$id=$data['id'];
			// 获取图集上传文件
			// 1、获取原图片集
			$imglist=Db::name('Photo')->find($id);
			$imgsrc=$imglist['img'];
			//2、获取后续添加图集
		    $files = request()->file('img');
		    if($files != null){
			    $data['img']=array();
			    foreach($files as $k=>$file){
			        // 移动到框架应用根目录/public/uploads/ 目录下
				    $path=ROOT_PATH . 'public/static/upload';
				    $info = $file->validate(['size'=>15678000,'ext'=>'jpg,png,gif'])->move($path);
				    if($info){
				        $str=$info->getSaveName();
				    	$str=str_replace("\\",'/',$str);
				        $data['img'][$k]=("/static/upload/".$str);
			        }else{
			           // 上传失败获取错误信息
				        $this->error($file->getError()); ;
			        }    
	    		}
	    		$data['img']=implode(',',$data['img']);
	    		$data['img']=$imgsrc.','.$data['img'];
		    }
		    // dump($data);exit;
			$result=$model->editPhoto($data);
			if($result){
				$this->success('修改成功','img/Photo/show_list');
			}else{
				$this->error('修改失败');
			}
		}else{
			$xclist=$model->findPhoto($id);
			$xclist['img']=explode(',',$xclist['img']);
			// dump($xclist);exit;
			$this->assign('xclist',$xclist);
			return $this->fetch();
		}
	}
	public function delpic(){
		$data=Request::instance()->post();
		$id=$data['id'];
		$imgid=$data['img'];
		$xcmodel=new xc;
		$xc=$xcmodel->findPhoto($id);
		$xc['img']=explode(',',$xc['img']);
		foreach($xc['img'] as $k=>&$vo){
			if($k == $imgid){
				$vo='';
			}
		}
		$xc['img']=implode(',',$xc['img']);
		$xc['img']=trim($xc['img'],',');
		$res=array();
		$res['id']=$id;
		$res['img']=$xc['img'];
		$result=$xcmodel->editPhoto($res);
		if($result){
			return '删除成功！';
		}else{
			return '删除失败!';
		}
	}


    public function fileUpload(){
        $file = \Request::file('file');
        if($msg = $file->isValid()){
            $oriainalName = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $type = $file->getClientMimeType();
            $data = $file->move(storage_path() . '/app/projectfile', $oriainalName);
            $filepath = '../storage/app/projectfile/'. $oriainalName;
        }
        if($msg){
            $bool = DB::insert("INSERT INTO projectfile (file_name,file_path) VALUES (?,?)",["$oriainalName","$filepath"]);
            if($bool){
                $id = DB::select("SELECT max(id) as id from projectfile");
                $id = $id[0]->id;
            }
        }
        $data=[
            'filepath'=>$filepath,
            'filename'=>$oriainalName,
            'id' =>$id
        ];
        $ret = new \stdClass();
        $ret->msg =$msg;
        $ret->data =$data;
        return response()->json($ret);
    }
    /**
     * 附件删除
     */
    public function fileDelete()
    {
        $id = \Request::input('id');
        $bool = DB::table('projectfile')->where('id','=',$id)->delete();
        $ret = new \stdClass();
        $ret ->data = $bool;
        return response()->json($ret);
    }
}