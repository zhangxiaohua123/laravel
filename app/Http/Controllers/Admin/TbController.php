<?php
namespace App\Http\Controllers\Admin;
use   App\Http\Controllers\Controller;

class TbController extends Controller {

//    public function __construct()
//    {
//        $this->middleware(function () {
//            if(!session('id')){
//                return redirect('guanli');
//            }
//        });
//    }
	public function  index(){
//	    dump(phpinfo());exit;
       return view('admin.tb.index');
    }
    public  function info(){
     	return  view('admin.tb.info');
    }
}