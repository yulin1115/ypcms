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
// | 页面创建时间: 2012-11-19
// +----------------------------------------------------------------------


class ArchiveAction extends CommonAction {

    public function _empty($url){
        //把所有类别自定义的URL当做操作解析到info方法
        $this->yulinresolve($url);
    }
        
    protected function yulinresolve($url){
		$Sort=M('Sort');
		import("@.ORG.Page");// 导入分页类
		$con['url']=$url;
		$con['status']=2;
		if(is_numeric($url)){
			$Archive=M('Archive');
			$con['id']=$url;
			$read=$Archive->where($con)->find();
			$read['newcontent']=cutstr_html($read['content']);//怎家过滤html后的内容元素供列表显示
			//print_r($read);
			if(!$read){
				parent::_empty();//404
			    exit();
			}else{
				$Archive->where('id='.$url)->setInc('clicks');
			}
			//获取评论
			$map['record_id']=$url;
			$map['status']=2;
			$Comment=M('Comment');
			$comment=$Comment->where($map)->order('id desc')->select();
			$comments=genTree($comment,'id','review_id');
			//print_r($comments);
			$countcomment=count($comments);
			//print_r($comments);
//			session_destroy();
			//print_r($_SESSION);
			$down=M('Attach')->where('record_id='.$url)->select();
			$this->assign('down',$down);
			$this->assign('countcomment',$countcomment);
			$this->assign('comments',$comments);
			$this->assign('read',$read);
			$this->display('read');
			exit();
		}
		$sortid=$Sort->where($con)->field('pointsort')->find();
		if(!$sortid){
			parent::_empty();//404
			exit();
		}
		$Archive=M('Archive');
		$con['sortid']=$sortid['pointsort'];
		$count = $Archive->where($con)->count();
		$Page  = new Page($count,6);
		$list = $Archive->where($con)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list as $k=>$v){
			$v['newcontent']=cutstr_html($v['content']);//怎家过滤html后的内容元素供列表显示
			if(!empty($v['tags'])){
			    $tagarray=explode(' ',$v['tags']);
				//print_r($tagarray);
				//$tagsarr=array();
				foreach($tagarray as $tagk=>$tagv){
					$tagsarr['name']=$tagv;
					$tagarray[$tagk]=$tagsarr;
					$v['taglist']=$tagarray;
				}
			}
			$list[$k]=$v;
		}
		//print_r($list);
		//print_r($sortid);
		$show = $Page->show();// 分页显示输出
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$this->display('info');
    }
	
    public function search(){
		//$Sort=M('Sort');
		import("@.ORG.Page");// 导入分页类
		//$con['url']=$url;
		$con['status']=2;
		$Archive=M('Archive');
		$con['title'] = array('like','%'.$_POST['search'].'%'); 
		$count = $Archive->where($con)->count();
		$Page  = new Page($count,6);
		$list = $Archive->where($con)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list as $k=>$v){
			$v['newcontent']=cutstr_html($v['content']);//怎家过滤html后的内容元素供列表显示
			$v['searchtitle']= str_replace($_POST['search'], "<font color='#3E6D8E'>".$_POST['search']."</font>", $v['title']);
			//echo $v['searchtitle'];
			if(!empty($v['tags'])){
			    $tagarray=explode(' ',$v['tags']);
				//print_r($tagarray);
				//$tagsarr=array();
				foreach($tagarray as $tagk=>$tagv){
					$tagsarr['name']=$tagv;
					$tagarray[$tagk]=$tagsarr;
					$v['taglist']=$tagarray;
				}
			}
			$list[$k]=$v;
		}
		//print_r($list);
		//print_r($sortid);
		$show = $Page->show();// 分页显示输出
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$this->display('info');
    }	

    public function down(){
        //把所有类别自定义的URL当做操作解析到info方法
        //$this->error($id);
		//$id=$_REQUEST['id'];
        R('Home/Down/down',array('5'));
    }		

}
?>