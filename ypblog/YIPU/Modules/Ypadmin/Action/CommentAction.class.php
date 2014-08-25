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
// | 页面创建时间: 2012-11-24
// +----------------------------------------------------------------------


class CommentAction extends CommonAction {
	
    public function index($map=array(),$sortBy='',$asc=false){
		$Comment = M('Comment'); // 实例化Form对象
		//print_r($User->getDbFields());
        import("@.ORG.Page");// 导入分页类
        //列表过滤器，生成查询Map对象
		if(isset($_REQUEST['mid']) && $_REQUEST['sortid'] != -1){
			$map['module']=$_REQUEST['mid'];	
		}
		if(isset($_REQUEST['title'])){
			$map['content']=array('like','%'.$_REQUEST['title'].'%');
		}
		if(isset($_REQUEST['status'])){
			$map['status']=$_REQUEST['status'];	
		}
		$map['review_id']=0;
		if($this->_get('record_id')){
			$map['record_id']=$this->_get('record_id');
		}
		if($this->_get('module')){
		    $map['module']=$this->_get('module');
		}
		$count=$Comment->where($map)->count();// 查询满足要求的总记录数						
        $Page       = new Page($count,6);// 实例化分页类 传入总记录数和每页显示的记录数
       
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $lists = $Comment->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach ($lists as $k=>$v){
			$review=$Comment->where('review_id='.$v['id'].'')->select();
			if(!empty($review)){
				$v['review']=$review;
				$lists[$k]=$v;
			}
			//print_r($review);
		}
		//print_r($lists); 
		foreach ($map as $key => $val) {//分页跳转保持搜索参数
            if (!is_array($val)) {
                $Page->parameter .= "$key=" . urlencode($val) . "&";
            }else{
				$Page->parameter .="$key=" . urlencode(str_replace('%','',$val[1])) . "&";
			}
        }
		//print_r($list); 
		//$lists=genTree($list,'id','review_id');
		//print_r($lists);
	    $show = $Page->show();// 分页显示输出
        $this->assign('lists',$lists);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
	}

}
?>