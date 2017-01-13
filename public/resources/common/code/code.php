<?php
	 session_start();

	/*1、实现验证码功能的具体实现步骤：
	 	1. 准备一个字体文件。

     		2. 定义一个函数：随机生成一个验证码的内容。
	
     		3. 开始绘画验证码（加干扰点，干扰线等）。

    		 4. 使用验证码。*/

    	//1. 准备一个字体文件。	 
    		 $ttf="./msyhbd.ttf";
    		 //在windows中查找一个微软雅黑字体
    	//2. 定义一个函数：随机生成一个验证码的内容。
    	function createNonceStr($length=5){
    		$str="abcdefghigklmnopqrstuvwxyz0123456789";
    		$str=str_shuffle($str);
    		$tempStr="";
    		for($a=1;$a<=$length;$a++){
    			//$tempStr.=$str[mt_rand(0,strlen($str)-1)];
    			$tempStr.=substr($str,mt_rand(0,strlen($str)-1),1);
    		}
    		 return $tempStr;	
    	} 
    	$a=createNonceStr(4);
    	$_SESSION['vcode']=$a;
    	//echo $a;
    	//3. 开始绘画验证码（加干扰点，干扰线等）。
	 //    	 1、创建画布、分配颜色
	 //    （1）、创建画布
		 $im=imagecreatetruecolor(103,35);

	 //    （2）、分配颜色（验证码颜色和背景颜色）
		$bgColor=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		$text_Color=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		$point_Color=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		$line_Color=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
	 //  2、开始绘画
		 imagefill($im,0,0,$bgColor);

		// （1）、随机添加干扰点
		 //bool imagesetpixel  ( resource $image  , int $x  , int $y  , int $color  )
		for($i=1;$i<=100;$i++){
			 imagesetpixel($im,mt_rand(0,263),mt_rand(0,35),$point_Color);
		}
		

		// （2）、随机添加干扰线
		//bool imageline  ( resource $image  , int $x1  , int $y1  , int $x2  , int $y2  , int $color  )
		 for($i=1;$i<=5;$i++){
		 imageline($im,mt_rand(1,262),mt_rand(1,34),mt_rand(1,263),mt_rand(1,34),$line_Color);
		}
		// （3）、绘制验证码内容
		 //array imagettftext  ( resource $image  , float $size  , float $angle  , int $x  , int $y  , int $color  , string $fontfile  , string $text  )
		imagettftext($im,28,0,5,30,$text_Color,$ttf,$a);

	 //  3、输出图像
		 header("Content-Type:image/png");

		imagepng($im);

	 //  4、销毁图片
		//imagedestroy($im);

?>