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


class PublicAction extends Action {

    public function _empty(){
	    header("HTTP/1.0 404 Not Found");
        $this->display('Public:404'); 
	}	
		
	public function index(){
		$this->display();
	}
	
	// 用户登出
    public function logout()
    {
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
			$loginId	=	$_SESSION['loginId'];
			unset($_SESSION['loginId']);
			unset($_SESSION[C('USER_AUTH_KEY')]);
			unset($_SESSION);
			session_destroy();
            $this->assign("jumpUrl",U('Public/index'));
            $this->success('登出成功');
        }else {
            $this->error('已经登出！',U('Public/index'));
        }
    }

	// 登录检测
	public function checkLogin() {
		$User=M('user');
		if(empty($_POST['username'])) {
			$this->error('帐号必须');
		}elseif (empty($_POST['password'])){
			$this->error('密码必须');
		}elseif (''===trim($_POST['verify'])){
			$this->error('验证码必须');
		}
        //生成认证条件
        $map            =   array();
		// 支持使用绑定帐号登录
		$map['account']	= $_POST['username'];
        $map["status"]	=1;
        if($_SESSION['verify'] != md5($_POST['verify'])) {
            $this->error('验证码错误');
        }
		import('@.ORG.RBAC');
        $authInfo = RBAC::authenticate($map);
        //使用用户名、密码和状态的方式进行认证
        if(!$authInfo) {
            $this->error('账号不存在或已经禁用');
        }else {
            if($authInfo['password'] != pwdHash($_POST['password'])) {
            	$this->error('密码错误');
            }
		    $Login=M('Role');
			$con['id']=$authInfo['nickname'];
			$loginname=$Login->where($con)->field('name')->find();	
            $_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['id'];
			$_SESSION['user']               =   $authInfo['account']; 
            $_SESSION['loginUserName']		=	$loginname['name'];
            $_SESSION['lastLoginTime']		=	$authInfo['lastlogintime'];
			$_SESSION['login_count']	    =	$authInfo['logincount'];
			$_SESSION['lastLoginIp']        =   $authInfo['lastloginip'];
			$_SESSION['time']               =   time();
           
            if($authInfo['account']=='admin') {
            	$_SESSION['administrator']		=	true;
            }
           // $_SESSION['user_type']    =  $authInfo[0]['type_id'];

            //保存登录信息
			
			$ip		=	get_client_ip();
			import('@.ORG.IpLocation');// 导入IpLocation类
            $Ip = new IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
            $area = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
			$time	=	time();
            //$data = array();
			//$data['id']	=	$authInfo[0]['id'];
			$data['lastlogintime']	=	$time;
			$data['logincount']	=	array('exp','(logincount+1)');
			$data['lastloginip']	=	$ip.' ('.$area['country'].'.'.$area['area'].')';
			$condition['id']=$authInfo['id'];
			$User->where($condition)->save($data);
           // $_SESSION['loginId']		=	$loginId;
			
            RBAC::saveAccessList(); 
			//
			$this->success('登录成功');
		}
	}


	// 修改资料
	public function change() {
		$this->checkUser();
		$User	 =	 D("User");
		if(!$User->create()) {
			$this->error($User->getError());
		}
		$result	=	$User->save();
		if(false !== $result) {
			$this->success('资料修改成功！');
		}else{
			$this->error('资料修改失败!');
		}
	}

    // 更换密码
    public function changePwd()
    {
		$this->checkUser();
        //对表单提交处理进行处理或者增加非表单数据
		if(md5($_POST['verify'])	!= $_SESSION['verify']) {
			$this->error('验证码错误！');
		}
		$map	=	array();
        $map['password']= pwdHash($_POST['oldpassword']);
        if(isset($_POST['account'])) {
            $map['account']	 =	 $_POST['account'];
        }elseif(isset($_SESSION[C('USER_AUTH_KEY')])) {
            $map['id']		=	$_SESSION[C('USER_AUTH_KEY')];
        }
        //检查用户
        $User    =   M("User");
        if(!$User->where($map)->field('id')->find()) {
            $this->error('旧密码不符或者用户名错误！');
        }else {
			$User->password	=	pwdHash($_POST['password']);
			$User->save();
			$this->assign('jumpUrl',__APP__.'/Public/main');
			$this->success('密码修改成功！');
         }
    }

	// 验证码显示
	public function verify()
    {
        import("@.ORG.Image");
        Image::buildImageVerify(4);
    }


	
}
?>