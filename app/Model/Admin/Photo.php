<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/25 0025
 * Time: 18:30
 */
namespace  App\Model\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class  Photo  extends  Model{
    public  static  function selectPhoto($count){
        $res=DB::table('blog_photo')->paginate($count);
        return $res;
    }

    public  static  function savePhoto($data){
        $res=DB::table('blog_photo')->insert($data);
        return $res;
    }
}