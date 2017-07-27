<?php
	// +----------------------------------------------------------------------
	// | [ I AM WHO I AM, IT IS NOT THE SAME AS FIREWORKS  ]
	// +----------------------------------------------------------------------
	// | '理论'是你知道是这样，但它却不好用。'实践'是它很好用，但你不知道是为什么。
	// | 程序员将理论和实践结合到一起：既不好用，也不知道是为什么。
	// +----------------------------------------------------------------------
	// | 优秀的判断力来自经验，但经验来自于错误的判断。
	// +----------------------------------------------------------------------
	// | Author: undefined
	// +----------------------------------------------------------------------
	header('Content-type:text/html;charset=utf-8');
	/**
	* 格式化输出一段信息
	* @param mixed $obj 要输出的内容
	* @return void
	*/ 
	function dump($obj){
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
	}

 
	/**
	* 发送一条sql语句，并且在sql语句错误的时候输出sql的错误信息
	* @param string $sql 要发送的sql语句
	* @return void
	*/ 
	function query($sql){
		// 发送一条查询语句
		$res = mysql_query($sql);

		// 如果sql语句错误，输出错误信息 并退出脚本 如果成功，返回结果集 
		if(!$res){
			echo mysql_error().'<br />';
			exit();
		}
		return $res;
	}


	/**
	* 获取一个文件或者目录的8进制权限
	* @param string $fileName
	* @return int 八进制权限
	*/ 
	function getFilePerms($fileName){
		return substr(base_convert(fileperms($fileName),10,8), -4);
	}


	/**
	* 计算一个整数的阶乘
	* @param int $num 整数
	* @return int 阶乘
	*/ 
	function factorial($num){
		if($num==1) return 1;
		return $num*factorial($num-1);
	}


	/**
	* 统计出一个文件夹下面目录的数量和文件的数量(引用传值)
	* @param string $dir 目录名
	* @return array (目录数量，文件数量)
	*/ 
	function countFilesNumA($dir,&$dirNum=0,&$fileNum=0){
		// 打开句柄
		$handle = opendir($dir);
		// 读取. 和..
		readdir($handle);
		readdir($handle);

		while($fileName = readdir($handle)){

			// 拼接成路径
			$newFile = "$dir/$fileName";

			// 如果是目录递归
			if(is_dir($newFile)){
				$dirNum++;
				countFilesNum($newFile,$dirNum,$fileNum);
			}else{
				$fileNum++;
			}
		}

		// 关闭句柄
		closedir($handle);

		// 返回目录数量和文件数量
		return array($dirNum,$fileNum);
	}


	/**
	* 统计出一个文件夹下面目录的数量和文件的数量
	* @param string $dir 目录名
	* @return array (目录数量，文件数量)
	*/ 
	function countFilesNumB($dir){
		// 打开句柄
		$handle = opendir($dir);
		// 读取. 和..
		readdir($handle);
		readdir($handle);

		$dirNum  = 0;
		$fileNum = 0;

		while(($fileName = readdir($handle))||($fileName!==false)){
			// 拼接成路径
			$newFile = "$dir/$fileName";

			// 如果是目录递归
			if(is_dir($newFile)){
				$dirNum++;
				$res = countFilesNumB($newFile);
				$dirNum  += $res[0];
				$fileNum += $res[1];
			}else{
				$fileNum++;
			}
		}

		// 关闭句柄
		closedir($handle);

		// 返回目录数量和文件数量
		return array($dirNum,$fileNum);
	}


	/**
	* 删除一个目录
	* @param $dir 目录名
	* @return bool true|false
	*/ 
	function delDir($dir){
		// 打开句柄
		$handle = opendir($dir);

		// 读取.和..
		readdir($handle);
		readdir($handle);

		// 循环
		while(($fileName = readdir($handle))||($fileName!==false)){
			// 拼接路径
			$newFile = "$dir/$fileName";
			if(is_dir($newFile)){
				if(!delDir($newFile)){return false;}
			}else{
				unlink($newFile);
			}
		}

		// 关闭句柄
		closedir($handle);
		// 删除目录
		if(rmdir($dir)) return true;
		return false;
	}


	/**
	* 实现一个文件的下载
	* @param string $fileName 下载文件的路径
	* @return void
	*/ 
	function doDownload($fileName){
		// 1、设置响应头为八进制数据流
		header('Content-type:application/octet-stream');

		// 2、告诉浏览器传送数据编码方式为2进制
		header('Content-Transfer-Encoding: binary');

		//3、支持断点续传  需要服务器支持断点续传功能
		header('Accept-Ranges:bytes');

		// 4、告诉客户端文件大小
		$filesize = filesize($fileName);
		header("Accept-Length:$filesize");

		// 5、告诉浏览器文件下载方式,以及下载的文件名
		$tmpName = explode('/', $fileName);
		$tmpName = array_pop($tmpName);
		header("Content-Disposition:attachment;filename=$tmpName");

		// 清空前面输出
		ob_end_clean();

		//6、输出文件流
		$handle = fopen($fileName, 'rb');
		while($con = fread($handle, 1024)){
			echo $con;
		}
	}


	/**
	* 生成一个3-6位的验证码
	* @param 验证码的长度
	* @return void
	*/ 
	function makeCode($len=4){
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


	/**
	* 上传一个文件
	* @param array $file 里面包含五个元素
	* @param int $fileMaxSize 上传文件最大的大小
	* @param array $extArray 允许的扩展名数组
	* @param array $mimeArray 允许的mime类型数组
	* @param string $path 上传文件保存的路径
	* @return array('upload_success'=>bool,'error_code'=>int,'error_info'=>'错误信息','file_path'=>'上传后文件保存的路径')
	*/ 
	function doUpload($file, $fileMaxSize, $extArray, $mimeArray, $path){
		// 系统错误
		if($file['error'] != 0){
			return changeCode($file['error']);
		}

		// 逻辑需要
		// 判断文件大小
		if($file['size']>$fileMaxSize){
			return changeCode(5);
		}

		// 判断扩展名是否符合规范
		$ext = $file['name'];
		$ext = explode('.', $ext);
		$ext = array_pop($ext);
		if(!in_array($ext, $extArray)){
			return changeCode(8);
		}

		// 安全需要 
		// 取出文件的真实的mime类型
		$finfo = finfo_open(FILEINFO_MIME);
		$mime = finfo_file($finfo, $file['tmp_name']);
		$mime = explode(';', $mime);
		$mime = array_shift($mime);
		if(!in_array($mime, $mimeArray)){
			return changeCode(9);
		}

		// 拼接基于分钟的文件夹
		$dir = $path.'/'.date('Y-m-d-H-i');

		// 目录不存在生成目录
		if(!is_dir($dir)){
			mkdir($dir,0777,true);
		}

		// 随机永不重复名字
		$tmpName = uniqid().$file['name'];

		// 拼接成完整路径
		$destination = $dir.'/'.$tmpName;

		// 移动上传文件
		if(move_uploaded_file($file['tmp_name'], $destination)){
			return array('upload_success'=>true,'error_code'=>0,'error_info'=>'上传成功','file_path'=>$destination);
		}
	}


	/**
	* 将错误的编号转为错误的信息
	* @param int $code 错误编号
	* @return array('upload_success'=>bool,'error_code'=>int,'error_info'=>'错误信息','file_path'=>'上传后文件保存的路径')
	*/ 
	function changeCode($code){
		switch($code){
			// 上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。
			case 1: $error_info = '上传文件过大';
			break;

			// 上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 
			case 2: $error_info = '上传文件过大';
			break;

			// 文件只有部分被上传。
			case 3: $error_info = '上传错误，请重新上传';
			break;

			// 没有文件被上传。 
			case 4: $error_info = '上传错误，请重新上传';
			break;

			// 找不到临时文件夹。
			case 6: $error_info = '上传异常，请联系管理员';
			break;

			// 文件写入失败。
			case 7: $error_info = '上传异常，请联系管理员';
			break;

			// 超过了自定义的文件大小
			case 5: $error_info = '上传文件过大';
			break;

			// 扩展名不正确
			case 8: $error_info = '上传文件类型不符合规范';
			break;

			// mime类型不正确
			case 9: $error_info = '/(ㄒoㄒ)/~~';
			break;

			default;
		}
		return array('upload_success'=>false,'error_code'=>$code,'error_info'=>$error_info,'file_path'=>null);
	}


	/**
	* 实现图像的等比缩放
	* @param string $fileName 图像的完整路径
	* @param float $scale 缩放比例 比如0.5表示等比缩放0.5倍
	* @return string $newFile 生成的新的图像的路径
	*/ 
	function geometricScaling($fileName,$scale=0.5){
		$ext = array('', 'gif', 'jpeg', 'png');

		// 获取旧图像的信息
		$imgInfo = getimagesize($fileName);

		// 拼接和图像相对应函数名
		$funName = 'imagecreatefrom'.$ext[$imgInfo[2]];

		// 旧图像资源
		$src_image = $funName($fileName);

		// 旧图像宽度
		$src_w = $imgInfo[0];

		// 旧图像高度
		$src_h = $imgInfo[1];

		// 新图像宽度
		$dst_w = $src_w*$scale;

		// 新图像的高度
		$dst_h = $src_h*$scale;

		// 创建一个空画布，用来容纳裁剪后的图像
		$dst_image = imagecreatetruecolor($dst_w, $dst_h);

		// 实现图像等比缩放
		imagecopyresampled($dst_image, $src_image,0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

		// 拼接输出函数名
		$funName = 'image'.$ext[$imgInfo[2]];

		// 生成一个新的地址
		$newName = explode('/', $fileName);
		// 求数组最大下标
		$maxIndex = count($newName)-1;
		// 将文件名重新赋值
		$newName[$maxIndex] = $scale.'_'.$newName[$maxIndex];
		// 拼接成新的路径
		$newName = implode('/', $newName);

		// 保存图像
		$funName($dst_image,$newName);

		// 释放内存
		imagedestroy($dst_image);
		imagedestroy($src_image);
		return $newName;
	}
