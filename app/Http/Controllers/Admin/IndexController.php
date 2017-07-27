<?php
namespace  App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller{
  //后台登陆
    public function index(Request  $request){
//       echo  test1();exit;
         if($request->isMethod('POST')){
            $data=$request->input();
            $res=DB::table('blog_user')->where('name',$data['name'])->first();
            if($res->pwd == md5($data['pwd'])){
                session(['name'=>$res->name]);
                session(['id'=>$res->id]);
                return   redirect('admin/index')->with('success','登录成功！');
            }else{
                return   redirect('guanli')->with('error','登录失败');
            }
        }
        return view('admin.index.index');
    }

    public function out(){
        session()->flush();
      return redirect('guanli')->with('success','退出成功！');
    }




    //验证码
    public function makeCode($len=4){
        // 限制长度为3-6
        $len = ($len>6) ? 6 : $len;
        $len = ($len<3) ? 3 : $len;

        // 创建真彩画布
        $img = imagecreatetruecolor(100, 40);

        // 给画布分配随机背景颜色
        $bgColor = imagecolorallocate($img, mt_rand(180,255), mt_rand(180,255), mt_rand(180,255));

        // 给画布填充背景颜色
        imagefill($img, 0, 0, $bgColor);

        // 字符库
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        // 取出最大下标
        $maxIndex = strlen($str)-1;

        // 定义验证码初始值
        $code = '';
        $flag = 0;
        while($flag<$len){
            // 给文字随机颜色
            $color = imagecolorallocate($img, mt_rand(0,100), mt_rand(0,100), mt_rand(0,100));

            // 随机取出一个字符
            $tmpStr = $str{mt_rand(0,$maxIndex)};
            $code .=  $tmpStr;
            $x = (105-$len*15)/2+$flag*15;

            // 写入字符串
            imagestring($img, 5, $x, 10, $tmpStr, $color);
            $flag++;
        }

        // 将验证码存储到session中
        session_start();
        $_SESSION['code'] = $code;

        // 循环100个像素点
        for($i=0; $i<100; $i++){
            $color = imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
            imagesetpixel($img, mt_rand(0,100), mt_rand(0,40), $color);
        }

        // 输出验证码并释放内存
        header('Content-type:image/jpeg');

        // 清空前面输出
        ob_end_clean();

        imagejpeg($img);
        imagedestroy($img);
    }
    
}