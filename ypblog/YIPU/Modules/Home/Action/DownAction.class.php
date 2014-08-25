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
// | 页面创建时间: 2012-12-19
// +----------------------------------------------------------------------


class DownAction extends CommonAction {

    
//	public function _before_yulinresolve(){
//        echo 'before<br/>';
//    }       
    
	public function down($id){
		
        $Attach     =   M("Attach");
        $map['id'] =  $_REQUEST['id'];
		$attach=$Attach->where($map)->find();
		//$this->success($attach['status']);
			if($attach) {
				//$attachname=str_insert($attach['savename'],9,'m_');
				//$filename   = $attach['savepath'].str_insert($attach['savename'],9,'m_');//下载图片，因为图片有前缀
				if( in_array(strtolower($attach['extension']),array('gif','jpg','jpeg','bmp','png','swf'))) {
					$filename   = $attach['savepath'].'m_'.$attach['savename'];//下载图片有前缀
				}else{
					$filename   = $attach['savepath'].$attach['savename'];//下载文件，文件没有前缀
				}
				if(is_file($filename)) {
					$showname =iconv("UTF-8", "GB2312", $attach['name']);
					//$showname = auto_charset($attach['name'],'gbk','utf-8');
					if(!isset($_SESSION['downloadattach_'.$id])) {//没有关闭浏览器（检测到session）继续下载不计数
						// 下载计数
						$Attach->where('id='.$id)->setInc('download_count');
						$_SESSION['downloadattach_'.$id]   =  true;
					}
					import("@.ORG.Http");
					Http::download($filename,$showname);
				}else{
					$this->error($filename);
				}
			}else{
				$this->error('附件不在可能被删除，如需要请联系管理员！');
			}
	}
		

}
?>