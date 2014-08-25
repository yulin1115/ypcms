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
// | 页面创建时间: 2012-11-20
// +----------------------------------------------------------------------


class MessageAction extends CommonAction {

   public function index(){
	   echo __ROOT__;
		$Message = M('Message'); // 实例化Form对象
		//print_r($User->getDbFields());
        import("@.ORG.Page");// 导入分页类
		//$map['status']=2;						
        $list      = $Message->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($list,10);// 实例化分页类 传入总记录数和每页显示的记录数
       
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $lists = $Message->where($map)->limit($Page->firstRow.','.$Page->listRows)->select(); 
		//print_r($lists); 
	    $show = $Page->show();// 分页显示输出
        $this->assign('lists',$lists);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
	}	

    public function message(){
		if(''===trim($_POST['verify'])){
			$this->error('请填写验证码!');
		}elseif($_SESSION['verify'] != md5($_POST['verify'])){
            $this->error('验证码错误');
        }else{		
            $this->insert('留言成功,审核后可见','留言失败');
		}
    }			

}
?>