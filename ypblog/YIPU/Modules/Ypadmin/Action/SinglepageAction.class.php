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
// | 页面创建时间: 2012-11-15
// +----------------------------------------------------------------------


class SinglepageAction extends CommonAction {

    public function index(){
		$Singlepage=M('Singlepage');
		$single=$Singlepage->select();
		$this->assign('single',$single);		
		$this->display();
	}
	
	public function del(){
        $Module=M(MODULE_NAME);
		if(isset($_REQUEST['id'])){
		    $con['id'] = $_REQUEST['id'];
			$content=$Module->where($con)->field('content')->find();
			if($Module->where($con)->delete()){
				delContentPic($content['content']);
			    $this->success('删除成功');
		    }else{
			    $this->error('删除失败');
		    }			
		}
		if(!empty($_POST['aids'])){
			$aid=$_POST['aids'];
			//$this->success($aids[1]);
			$aids=explode('YIPU',$aid);
			if(is_array($aids)){
				foreach($aids as $k=>$v){
					$con['id']=$v;
					$content=$Module->where($con)->field('content')->find();
				    delContentPic($content['content']);	
					$Module->where($con)->delete();	
				}
				$this->success('删除成功');
			}
		}else{
			$this->error('你没有选择任何选项');
		}
	}
	
}
?>