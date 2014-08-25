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
// | 页面创建时间: 2012-09-18
// +----------------------------------------------------------------------


class CommonAction extends Action {
    public function _initialize() {
		//echo $_SESSION[C('USER_AUTH_KEY')];
        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
            import('@.ORG.RBAC');
            if (!RBAC::AccessDecision(GROUP_NAME)) {
                //检查认证识别号
                if (!$_SESSION[C('USER_AUTH_KEY')]) {
                    //跳转到认证网关
                    redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                }
                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
                    if (C('GUEST_AUTH_ON')) {
                        $this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
                    }
                    // 提示错误信息
                    $this->error(L('_VALID_ACCESS_'));
                }
            }			
        }
		// 读取系统配置参数
/*        if(!file_exists(DATA_PATH.'~config.php')) {
            $config		=	M("Config");
            $list			=	$config->getField('name,value');
            $savefile		=	DATA_PATH.'~config.php';
            // 所有配置参数统一为大写
            $content		=   "<?php\nreturn ".var_export(array_change_key_case($list,CASE_UPPER),true).";\n?>";
            if(!file_put_contents($savefile,$content)){
                $this->error('配置缓存失败！');
            }
        }
		C(include_once DATA_PATH.'~config.php');*/
		$nowtime=time();
		$s_time=$_SESSION['time'];
		if (($nowtime - $s_time) > C('SAFETY_TIME')) {
			session_destroy();
			$this->error('请重新登录！',U('Public/index'));
		}else{
			$_SESSION['time'] = $nowtime;
		}
		//echo $_SESSION['time'].'/';
		//echo $nowtime-$s_time;				
		$this->menu();
		//print_r($_SESSION);	
		$username=$_SESSION['loginUserName'];
		$user=$_SESSION['user'];
        $this->assign('user',$user);		
        $this->assign('username',$username);
		//print_r($menu);
		

//        // 用户权限检查
//        if (!$_SESSION[C('USER_AUTH_KEY')]) {
//        //跳转到认证网关
//        redirect(PHP_FILE . '/Ypadmin');
//		}
        
		//print_r($menu);
		
//		$User=M('permissionUsers');
//		$userid=$_SESSION[C('USER_AUTH_KEY')];
//		$usergroupid=$User->getFieldByUser_id($userid,'user_groupid');
//		//print_r($usergroupid);
//		$Group=M('permissionGroups');
//		$usergroup=$Group->getFieldByGroup_id($usergroupid,'group_access,group_name');
//		$useraccess=array_keys($usergroup);
//		$usergroupname=array_values($usergroup);
//		//print_r($useraccess);
//		$usermodules=explode('#',$useraccess[0]);
//		$as=array( 'module^-^1,3', 'action^-^add,edit,delete ');
//		//print_r($as);
//		$usermodule=explode('^-^',$usermodules[0]);
//		$Module=M('module');
//		$moduleid['module_id']= array('in',$usermodule[1]);
//		$module=$Module->where($moduleid)->select();
//		if(!in_array(MODULE_NAME,$module)){
//			$this->error('没有权限');
//		}
//        foreach($module as $modulename){
//		    if(!in_array(MODULE_NAME,$modulename)){
//				echo "没有";
//			}
//		}
			
//		$this->assign('modulename',MODULE_NAME);
//		$this->assign('usergroupname',$usergroupname[0]);
		
//		$this->assign('module',$module);
		
		//print_r($usermodule);
		
		
		
		//print_r($module);
	}


    public function menu(){
		    if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
            $menu  = array();
			//print_r($_SESSION);
            if(isset($_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]])) {
				//print_r($_SESSION);

                //如果已经缓存，直接读取缓存
                $menu   =   $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]];
				///print_r($menu);
            }else {
                //读取数据库模块列表生成菜单项
                $node    =   M("Node");
				$id	=	$node->getField("id");
				$where['level']=2;
				$where['status']=1;
				$where['pid']=$id;
                $list	=	$node->where($where)->field('id,name,title,type')->order('sort asc')->select();			
				$accessList = $_SESSION['_ACCESS_LIST'];
				//echo GROUP_NAME;
                foreach($list as $key=>$module) {
                     if(isset($accessList[strtoupper(GROUP_NAME)][strtoupper($module['name'])]) || $_SESSION['administrator']) {//找出session中记录的权限与查出所有模块的交集
                        //设置模块访问权限
                        $module['access'] = 1;
                        $menu[$key]  = $module;
                    }
                }
                //缓存菜单访问
                $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]]	=	$menu;
            }
			//dump($menu);
            
		}
		//print_r($menu);
		$this->assign('menu',$menu);
	}
	



//    public function index() {
//        //列表过滤器，生成查询Map对象
//        $map = $this->_search();
//		print_r($map);
//        if (method_exists($this, '_filter')) {
//            $this->_filter($map);
//        }
//        $model = M($this->getActionName());
//        if (!empty($model)) {
//            $this->_list($model, $map);
//        }
//        $this->display();
//        return;
//    }

/* 获取分类 */
	function getsort($action){
		//echo $action;
		$Node=M('Node');
        $con['name']=$action;
		$moduleid=$Node->where($con)->field("module")->find();
		//print_r($moduleid);
		$cons['moduleid']=$moduleid['module'];
        import("@.ORG.Tree");
        $cat = new Tree('Sort', array('id', 'pid', 'name', "cname"));
        $sorts = $cat->getList($cons); //获取分类结构	
		
		return $sorts;
	}

    function saveTag($tags,$id,$module)
    {
		
        if(!empty($tags) && !empty($id)) {
            $Tag = M("Tag");
            $Tagged   = M("Tagged");
            // 记录已经存在的标签
            $exists_tags  = $Tagged->where("module='{$module}' and record_id={$id}")->getField("id,tag_id");
            $Tagged->where("module='{$module}' and record_id={$id}")->delete();
			//$this->success($module);
            $tags = explode(' ',$tags);
            foreach($tags as $key=>$val) {
                $val  = trim($val);
                if(!empty($val)) {
                    $tag =  $Tag->where("module='{$module}' and name='{$val}'")->find();
                    if($tag) {
                        // 标签已经存在
                        if(!in_array($tag['id'],$exists_tags)) {
							$Tag->where('id='.$tag['id'])->setInc('count');
                        }
                    }else {
                        // 不存在则添加
						$tag = array();
                        $tag['name'] =  $val;
                        $tag['count']  =  1;
                        $tag['module']   =  $module;
                        $result  = $Tag->add($tag);
                        $tag['id']   =  $result;
                    }
                    // 记录tag关联信息
                    $t = array();
                    $t['user_id'] = '1';
                    $t['module']   = $module;
                    $t['record_id'] =  $id;
                    $t['create_time']  = time();
                    $t['tag_id']  = $tag['id'];
                    $Tagged->add($t);
                }
            }
        }
    }
	
    /**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param string $name 数据对象名称
      +----------------------------------------------------------
     * @return HashMap
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _search($name = '') {
        //生成查询条件
        if (empty($name)) {
            $name = $this->getActionName();
			//echo $name;
        }
        $model = M($name);
        $map = array();
        foreach ($model->getDbFields() as $key => $val) {
            if (substr($key, 0, 1) == '_')
                continue;
            if (isset($_REQUEST[$val]) && $_REQUEST[$val] != '') {
                $map[$val] = $_REQUEST[$val];
            }
        }
        return $map;
		print_r($model->getDbFields());
    }


    public function upload() {
//        if (!empty($_FILES)) {
            //如果有文件上传 上传附件
            $this->_upload();
//        }else{
//			$this->error($_FILES);
//		}
    }

    protected function _upload() {
        import('@.ORG.UploadFile');
        //导入上传类
        $upload = new UploadFile();
        $upload  = $this->_upload_init($upload);
        if (!$upload->upload()) {
            //捕获上传异常
            $this->error($upload->getErrorMsg());
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();
			//print_r($uploadList);
            import('@.ORG.Image');
            //给m_缩略图添加水印, Image::water('原文件名','水印图片地址')
			foreach($uploadList as $key=>$data) {
                Image::water($data['savepath'] . 'm_' . $data['savename'],'./Public/Ypadmin/images/home.gif');
			}
			$_POST['image'] = $uploadList[0]['savename'];
        }
        $model  = M('Attach');
        //保存当前数据对象
		$remark	 =	 $_POST['remark'];
		foreach($uploadList as $key=>$data) {
            $data['image']          = $_POST['image'];
            $data['create_time']    = NOW_TIME;
			$data['remark']		=	 $remark[$key]?$remark[$key]:($remark?$remark:'');
		    $data['module']=$_POST['_uploadFileTable'];
		    $data['record_id']=$_POST['_uploadRecordId']?$_POST['_uploadRecordId']:0;
		    $data['user_id']=$_POST['_uploadUserId'];
		    $data['status']=$_POST['status']?$_POST['status']:0;
            $list   = $model->add($data);
		}
        if ($list !== false) {
            $this->success('上传图片成功！');
        } else {
            $this->error('上传图片失败!');
        }
    }

    public function add(){
        $sorts=$this->getsort(MODULE_NAME);
		$kindeditor=editor("content","content","730","500","");//加载编辑器
		$this->assign('editor',$kindeditor);		
		$this->assign('sorts',$sorts);
		$this->display();
	}	

    public function insert() {
		$Sort=D(MODULE_NAME);
		if ($Sort->create()){
			$resule=$Sort->add();
			if($resule){
				if(MODULE_NAME == 'User'){
					$sql="insert into (role_id,user_id) values ('$_POST[id]','$resule');";
					$result = $Sort->execute($sql);
				}
			    if(method_exists($this,'_tigger_insert')) {
                   // $tags = $Sort->getFieldById($resule,'tags');					 
                    $this->_tigger_insert($_POST['tags'],$resule,MODULE_NAME);
                }
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
           
        }else{
			$this->error($Sort->getError());
        }
    }

    public function edit($id=0){
        $sorts=$this->getsort(MODULE_NAME);
		$Edit=M(MODULE_NAME);
		$con['id']=$id;
		$edit=$Edit->where($con)->find();
		//print_r($edit);
		if(!$edit){
			$this->_empty();//如果没有查到信息就404
			exit();
		}
		$edit['newcontent']=htmlspecialchars($edit['content']);		
		$kindeditor=editor("content","content","730","500",$edit['newcontent']);//加载编辑器
		//print_r($edit);
		$this->assign('editor',$kindeditor);	
		$this->assign('edit',$edit);	
		$this->assign('sorts',$sorts);
		$this->display();
	}
	
    public function update() {
		$Sort=D(MODULE_NAME);
		if ($Sort->create()){
			if(false !== $Sort->save()){
				if(method_exists($this,'_tigger_update')) {
                    //$this->error($_POST['tags']);					 
                    $this->_tigger_update($_POST['tags'],$_POST['id'],MODULE_NAME);
                }
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
           
        }else{
			$this->error($Sort->getError());
        }
    }	

	public function del(){//删除产品同时删除产品所带的附件以及产品内容当中的图片
        $Module=M(MODULE_NAME);			
		if(isset($_REQUEST['id'])){
		    $con['id'] = $_REQUEST['id'];
			$map['record_id'] = $_REQUEST['id'];
			$map['module'] = MODULE_NAME;
			$Attach=M('Attach');
			$attachs=$Attach->where($map)->select();
			if($attachs){
			    foreach( $attachs as $attach){
				    $where['id']=$attach['id'];
					if(file_exists($attach['savepath'].$attach['savename'])){
						unlink($attach['savepath'].$attach['savename']);
					}
				    if(file_exists($attach['savepath'].'m_'.$attach['savename'])&&file_exists($attach['savepath'].'s_'.$attach['savename'])){
				        unlink($attach['savepath'].'m_'.$attach['savename'])&&unlink($attach['savepath'].'s_'.$attach['savename']);					    					    
				    }	
			        $Attach->where($where)->delete();				
			    }
			}
			$content=$Module->where($con)->field('content')->find();
			if($Module->where($con)->delete()){
				delContentPic($content['content']);
				$this->success('删除成功');
		    }else{
			    $this->error('删除失败');
			}       
		}	
		if(!empty($_POST['aids'])){
			$aid=$_POST['aids'];
			//$this->success($aids[1]);
			$aids=explode('YIPU',$aid);
			foreach($aids as $k=>$v){
				$con['id']=$v; 
			    $map['record_id'] = $v;
			    $map['module'] = MODULE_NAME;
			    $Attach=M('Attach');
			    $attachs=$Attach->where($map)->select();
				if($attachs){
			        foreach( $attachs as $attach){
				        $where['id']=$attach['id'];
					    if(file_exists($attach['savepath'].$attach['savename'])){
						    unlink($attach['savepath'].$attach['savename']);
					    }						
				        if(file_exists($attach['savepath'].'m_'.$attach['savename'])&&file_exists($attach['savepath'].'s_'.$attach['savename'])){
						    unlink($attach['savepath'].'m_'.$attach['savename'])&&unlink($attach['savepath'].'s_'.$attach['savename']);					    					    
				        }	
					    $Attach->where($where)->delete();			
			        }
				}
				if(MODULE_NAME != "Attach"){
					$content=$Module->where($con)->field('content')->find();
				    delContentPic($content['content']);				
			        $Module->where($con)->delete();
				}
			}
		    $this->success('删除成功');
		}else{
			$this->error('你没有选择任何选项');
		}
	}
	
	public function pass(){
		if(!empty($_POST['aids'])){
			$Module=M(MODULE_NAME);
			$aid=$_POST['aids'];
			$aids=explode('YIPU',$aid);
			foreach($aids as $K=>$v){
				$data['status']=$_REQUEST['id'];
				$con['id']=$v;
				$result=$Module->where($con)->save($data);
			}
			$this->success('更新成功');
			
		}else{
		    $this->error('你没有选择任何选项');
		}
	}
	
    public function _empty(){
	    header("HTTP/1.0 404 Not Found");
        $this->display('Public:404'); 
	}	

}

?>