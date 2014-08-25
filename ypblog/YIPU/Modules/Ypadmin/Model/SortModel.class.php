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
// | 页面创建时间: 2012-09-25
// +----------------------------------------------------------------------


class SortModel extends Model {
	protected $_map = array(
        'mid'    => 'moduleid', // 把表单中mid映射到数据表的moduleid字段
        'sname'  => 'name', 
		'order'  => 'paixu',
		'spid'   => 'pid',
		'nav'    => 'isnav',
		'mids'   => 'pointmodule',
		'sortid' => 'pointsort',
		'page'   =>  'pointpage'
    );
	
		// array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间])
	protected $_validate = array(
        array('moduleid','checkselect','所属模型:请选择模型','1','callback','3'), //默认情况下用正则进行验证
		array('name','require','分类名称:请填写分类名称','1'), // 分类名称必须
		//array('content','require','内容备注:请填写内容备注！','1'),
		array('paixu','number','排序:请填写数字','2'),//2表示排序有内容的时候验证是否是数字，五内容就不验证
       // array('name','','分类名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
        );
	protected  function checkselect($data){
		if($data==-1){
			return false;
		}else{
			return true;
		}
	}

}
?>