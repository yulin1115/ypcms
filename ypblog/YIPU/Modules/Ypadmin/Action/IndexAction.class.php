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
// | 页面创建时间: 2012-09-14
// +----------------------------------------------------------------------


class IndexAction extends CommonAction {
	
		
	public function add(){
		echo "index下面的add方法";
	}

    public function index(){
		

		$serverinfo=array(  '服务器域名/IP'     =>    $_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
		                    '服务器环境'        =>    $_SERVER['SERVER_SOFTWARE'],
							'服务器语言'        =>    getenv("HTTP_ACCEPT_LANGUAGE"),
							'服务器端口'        =>    $_SERVER['SERVER_PORT'],
							'绝对路径'          =>    $_SERVER['DOCUMENT_ROOT'],
							'PHP版'             =>    PHP_VERSION,
							'PHP运行方式'       =>    php_sapi_name(),
							'ThinkPHP版本'      =>    THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
                            '上传附件限制'      =>    ini_get('upload_max_filesize'),
                            '执行时间限制'      =>    ini_get('max_execution_time').'秒',
                            '服务器时间'        =>    date("Y年n月j日 H:i:s"),
                            '北京时间'          =>    gmdate("Y年n月j日 H:i:s",time()+8*3600),                          
                            '剩余空间'          =>    round((disk_free_space(".")/(1024*1024)),2).'M',		
		);
		import('@.ORG.Common');
		$info= new get_gust_info();
        $lastloginip    =   $_SESSION['lastLoginIp'];
		$lastlogintime  =   $_SESSION['lastLoginTime'];
		$logincount     =   $_SESSION['login_count'];
		$Os             =   $info->GetOs();
		$Browser        =   $info->GetBrowser();
		$Browserlan     =   $info->GetLang();
//		$ip             =   $info->Getip();
//		$ip1            =   $info->get_onlineip();
//		$addres         =   $info->Getaddress();
        $this->assign('lastloginip',$lastloginip);
		$this->assign('lastlogintime',$lastlogintime);
		$this->assign('logincount',$logincount);
		$this->assign('Os',$Os);
		$this->assign('Browser',$Browser);
		$this->assign('Browserlan',$Browserlan);
//		$this->assign('ip',$ip);
//		$this->assign('ip1',$ip1);
//		$this->assign('addres',$addres);
		$this->assign('serverinfo',$serverinfo);
		$this->display();
	}	

   


}
?>