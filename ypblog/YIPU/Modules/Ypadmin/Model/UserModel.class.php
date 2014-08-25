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
// | 页面创建时间: 2012-10-31
// +----------------------------------------------------------------------


class UserModel extends Model {
	protected $_map = array(
       'catids'    => 'nickname', 
	   'catid'    => 'status',
        'user'  => 'account', 
		'pw'  => 'password',
		'em'   => 'email',
		'beizhu'    => 'remark',
    );

    protected $_auto = array ( 
        array('password','md5',1,'function') , // 对password字段在新增和编辑的时候使MD5函数处理
		array('creattime','time',1,'function'), // 对creattime字段在插入时候写入当前时间戳
    );		
	
	protected $_validate = array(
        array('nickname','checkselect','所属分组:请选择分组','1','callback','3'), //默认情况下用正则进行验证
		array('account','require','用户名:请填写用户名','1'),
		array('account','','用户名:该用户名已存在','0','unique','1'),		
		array('password','require','密码:请填写密码','1'), 
		array('repw','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致	
		array('email','email','邮箱:请填写正确邮箱','2'),//2表示排序有内容的时候验证是否是数字，五内容就不验证
		array('email','','邮箱:该邮箱已存在','0','unique','1'),
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