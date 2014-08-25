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
// | 页面创建时间: 2012-10-24
// +----------------------------------------------------------------------


class ProductModel extends Model {
	protected $_map = array(
        'catid'           =>    'sort_id', // 把表单中mid映射到数据表的moduleid字段
        'order'           =>    'paixu', 
		'price1'          =>    'market_price',
		'price2'          =>    'shop_price',
		'sn'              =>    'number',
		'type'            =>    'attribute',
		'time'            =>    'creattime',
		'title'           =>    'name',
		'highlightfontC'  =>    'style',
    );	
	
    protected $_auto = array ( 
        array('creattime','strtotime',3,'function') , // 对creattime字段在新增和编辑的时候使strtotime函数处理
    );		
		// array(验证字段,验证规则,错误提示,[验证条件,附加规则,验证时间])
	protected $_validate = array(
        array('sort_id','checkselect','所属分类:请选择分类','1','callback','3'), //默认情况下用正则进行验证
		array('name','require','名称:请填写商品名称','1'), // 分类名称必须
		array('creattime','require','发布时间:请确认发布时间','1'),
		//array('content','require','内容备注:请填写内容备注！','1'),
		array('market_price','currency','市场价:正确填写价格','2'),
		array('shop_price','currency','优惠价:正确填写价格','2'),
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