<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25 0025
 * Time: 14:07
 */
namespace    App\Model\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model{
    public static  function selectblog($count){
        $res=DB::table('blog_blogger')->paginate($count);
        return $res;
    }

    public  static   function   findblog($id){
        $res=DB::table('blog_blogger')->where('id',$id)->first();
        return $res;
    }

    public  static   function   saveblog($data){
        $res=DB::table('blog_blogger')->insert($data);
        return $res;
    }

    public  static   function   delblog($id){
        $res=DB::table('blog_blogger')->where('id',$id)->delete();
        return $res;
    }

    public  static   function   updateblog($data){
        $res=DB::table('blog_blogger')->where('id',$data['id'])->update($data);
        return $res;
    }

}