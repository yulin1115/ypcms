<?php
// +----------------------------------------------------------------------
// | 系统：YIPUCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2012 YIPU All rights reserved.
// +----------------------------------------------------------------------
// | 本系统采用THINKPHP3.1框架开发
// +----------------------------------------------------------------------
// | 作者: YIPU <719655143@qq.com>
// +----------------------------------------------------------------------
// | 页面创建时间: 2013-3-2
// +----------------------------------------------------------------------

class QqAction extends CommonAction {

	public function qqlogin()
    {
		$backurl=$_SERVER['HTTP_HOST'].$_GET['backurl'];
		require_once(PUBLIC_PATH."Plug/QQAPI/qqConnectAPI.php");
		$qc = new QC();
		$qc->qq_login($backurl);
    }
	
	public function callbackqqlogin()
    {
		require_once(PUBLIC_PATH."Plug/QQAPI/qqConnectAPI.php");
		$qc = new QC();
		$accesstoken=$qc->qq_callback();
		$openid=$qc->get_openid();
		//$info=$qc->getqqinfo($accesstoken,$openid);
        $bc=new QC($accesstoken,$openid);	
		$infoarr=$bc->get_user_info();		
        $_SESSION['nickname']=$infoarr['nickname'];
		$_SESSION['figureurl']=$infoarr['figureurl_1'];
		$Member=D('Member');
		$Member->recordqq($infoarr['nickname'],$infoarr['figureurl_1'],$infoarr['gender']);
//print_r($infoarr);
		//echo $_SESSION[QC_userData]['backurl'];
//print_r($_SESSION);
		//print_r($_SERVER);
        header("Location:http://".$_SESSION[QC_userData]['backurl']);
    }	

	public function qqoutlogin()
    {
		$backurl=$_SERVER['HTTP_HOST'].$_GET['backurl'];
        session_destroy();
		header("Location:http://".$backurl);
    }	
}