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
// | 页面创建时间: 2013-03-06
// +----------------------------------------------------------------------


class MemberModel extends Model {
	
	public function recordqq($nickname,$figureurl,$gender)
    {
		$ip = get_client_ip();
	    import('@.ORG.IpLocation');// 导入IpLocation类
        $Ip = new IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
        $area = $Ip->getlocation($ip); // 获取某个IP地址所在的位置	
		$con['nickname']=$nickname;
		$user = $this->where($con)->field('id')->find();
		if(!empty($user)){
			$data['lastloginip'] =   $area['ip'];
			$data['logincount']	=	array('exp','(logincount+1)');
			$data['lastloginaddress']=$area['country'];
		    $data['lastlogintime'] =   time();
			$this->where('id='.$user['id'])->save($data);
		}else{
		    $data['nickname']  =   $nickname;
            $data['avatar'] =   $figureurl;
		    $data['gender'] =   $gender;
			$data['lastloginip'] =   $area['ip'];
			$data['lastloginaddress']=$area['country'];
		    $data['lastlogintime'] =   time();
			$this->add($data);
		}
    }


}
?>