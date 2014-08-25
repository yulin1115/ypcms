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
// | 页面创建时间: 2012-09-14
// +----------------------------------------------------------------------


class ConfigAction extends CommonAction {
    public function index(){
		$Config=M('Config');
		$config=$Config->select();
		$this->assign('config',$config);
		$this->display();
	}
	
	// 批量修改配置参数
    public function configupdate()
    {
        $Config = M("Config");
		$config=$_POST['config'];
		foreach($config as $key=>$value){
			$Config->query("REPLACE INTO `yulin_config` (name, value) VALUES ('{$key}','{$value}')","mysql_unbuffered_query");
		}
		$list			=	$Config->getField('name,value');
		$savefile		=	CONF_PATH.'~config.php';
		// 所有配置参数统一为大写
		$content		=   "<?php\nreturn ".var_export(array_change_key_case($list,CASE_UPPER),true).";\n?>";
		if(file_put_contents($savefile,$content)){
			$this->success('配置更新成功');
		}else{
			$this->error('配置缓存失败');
		}
    }	
	

}