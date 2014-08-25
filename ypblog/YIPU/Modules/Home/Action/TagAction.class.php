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
// | 页面创建时间: 2012-12-29
// +----------------------------------------------------------------------


class TagAction extends CommonAction {
	
    public function _empty($tagename){
        //把所有类别自定义的URL当做操作解析到info方法
        $this->yulinresolve($tagename);
    }	
        
    protected function yulinresolve($tagename){
		import("@.ORG.Page");// 导入分页类	
		//$con['name']=$tagename;
		//$con['status']=2;
		$Tag=M('Tag');
		$Tagged=M('Tagged');
		$Archive=M('Archive');
		$tagid=$Tag->getFieldByName($tagename,'id');
		$con['tag_id']=$tagid;
		$count = $Tagged->where($con)->count();
		$archiveid=$Tagged->where($con)->field('record_id')->select();	
		//print_r($archiveid);
		foreach ($archiveid as $v){
			$idstr.=$v['record_id'].",";
		}
		//echo $idstr;
		$map['id']  = array('in',$idstr);
		$map['status']=2;
		$Page  = new Page($count,5);
		$list = $Archive->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
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

}
?>