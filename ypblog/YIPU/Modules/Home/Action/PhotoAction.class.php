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
// | 页面创建时间: 2013-1-11
// +----------------------------------------------------------------------


class PhotoAction extends CommonAction {

    public function _empty($url){
        //把所有类别自定义的URL当做操作解析到info方法
        $this->yulinresolve($url);
    }
        
    protected function yulinresolve($url){
		$Sort=M('Sort');
		$con['url']=$url;
		$con['status']=2;
		$sortid=$Sort->where($con)->field('id')->find();
		if(!$sortid){
			parent::_empty();//404
			exit();
		}
		$Photo=M('Attach');
		$map['record_id']=$sortid['id'];
		$map['module']='Sort';
		$list=$Photo->where($map)->field('savename,savepath,remark')->limit(0,10)->select();
		//print_r($list);
		$count=$Photo->where($map)->count();
        foreach ($list as $k=>$v){
			//print_r($picname);
			$list[$k]['url_m']=C('WEB_LIST').$v['savepath'].'m_'.$v['savename'];
			$list[$k]['url_s']=C('WEB_LIST').$v['savepath'].'s_'.$v['savename'];
		}
		//echo $count;
		$index=ceil($count/3);
		//print_r($list);
		//print_r($sortid);\
		$this->assign('list',$list);
		$this->assign('index',$index);
		//$this->assign('page',$show);// 赋值分页输出
		$this->display('info');
    }
	
    public function getpic(){
		$Sort=M('Sort');
		$con['url']=$this->_get('mid');
		$con['status']=2;
		$sortid=$Sort->where($con)->field('id')->find();
		if(!$sortid){
			parent::_empty();//404
			exit();
		}
		$Photo=M('Attach');
		$map['record_id']=$sortid['id'];
		$map['module']='Sort';
		$list=$Photo->where($map)->field('savename,savepath,remark')->limit($_REQUEST['page']*6+1,6)->select();
		//print_r($list);
        foreach ($list as $k=>$v){
			//print_r($picname);
			$list[$k]['url_m']=C('WEB_LIST').$v['savepath'].'m_'.$v['savename'];
			$list[$k]['url_s']=C('WEB_LIST').$v['savepath'].'s_'.$v['savename'];
			$height=getimagesize(".".$list[$k]['url_m']);
			//print_r($height);
			$list[$k]['imageheight']=$height[1];
			$list[$k]['imagewidth']=$height[0];
		}
		//print_r($list);
		//print_r($sortid);
		$data['status'] = 1;
        $data['list'] = $list;
		$this->ajaxReturn($data);
    }			

}
?>