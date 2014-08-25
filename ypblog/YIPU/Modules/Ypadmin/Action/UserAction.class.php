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


class UserAction extends CommonAction {
	
    public function index($map=array(),$sortBy='',$asc=false){
		$User = M('User'); // 实例化Form对象
		//print_r($User->getDbFields());
        import("@.ORG.Page");// 导入分页类
        //列表过滤器，生成查询Map对象
        //排序字段 默认为主键名
        if(isset($_REQUEST['_order'])) {
            $order = $_REQUEST['_order'];
        }else {
            $order = !empty($sortBy)? $sortBy: $User->getPk();
        }
        //排序方式默认按照倒序排列
        //接受 sost参数 0 表示倒序 非0都 表示正序
        if(isset($_REQUEST['_sort'])) {
            $sort = $_REQUEST['_sort']?'asc':'desc';
        }else {
            $sort = $asc?'asc':'desc';
        }
		if(isset($_REQUEST['sortid']) && $_REQUEST['sortid'] != -1){
			$map['author']=$_REQUEST['sortid'];	
		}
		if(isset($_REQUEST['title'])){
			$map['title']=array('like','%'.$_REQUEST['title'].'%');	
		}	
					
        $count      = $User->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
       
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $lists = $User->where($map)->order('paixu asc,'.$order.' '.$sort)->limit($Page->firstRow.','.$Page->listRows)->select(); 
		if(!empty($lists)){
		    foreach($lists as $key=>$value){
			    $Sort=M('Role');
			    $con['id']=$value['nickname'];
			    $sort=$Sort->where($con)->field('name')->select();
			    $value['sortname']=$sort[0]['name'];
			    $list[$key]=$value;
		    }
		}
		foreach ($map as $key => $val) {//分页跳转保持搜索参数
            if (!is_array($val)) {
                $Page->parameter .= "$key=" . urlencode($val) . "&";
            }else{
				$Page->parameter .="$key=" . urlencode(str_replace('%','',$val[1])) . "&";
			}
        }
		//print_r($list); 
	    $show = $Page->show();// 分页显示输出
		$Sort=M('Role');
		$sorts=$Sort->select();
		$this->assign('sorts',$sorts);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
	}	

    public function useradd() {
		$Sort=M('Role');
		$sorts=$Sort->select();
		$this->assign('sorts',$sorts);
        $this->display();
    }
	
    public function useredit($id=0) {
		$Edit=M('User');
		$con['id']=$id;
		$Sort=M('Role');
		$sorts=$Sort->select();		
		$edit=$Edit->where($con)->find();
		//print_r($edit);
		$this->assign('edit',$edit);
		$this->assign('sorts',$sorts);		
        $this->display();
    }	

    public function userupdate() {
		$rules = array(
       // array('nickname','checkselect','所属分组:请选择分组','1','function','3'), //默认情况下用正则进行验证
		array('account','require','用户名:请填写用户名','1'),
		//array('account','','用户名:该用户名已存在','0','unique','1'),		
		array('password','require','密码:请填写密码','1'), 
		array('repw','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致	
		array('email','email','邮箱:请填写正确邮箱','2'),//2表示排序有内容的时候验证是否是数字，五内容就不验证
		//array('email','','邮箱:该邮箱已存在','0','unique','1'),
       // array('name','','分类名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
        );
		$rules1= array ( 
        array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使MD5函数处理
		//array('creattime','time',1,'function'), // 对creattime字段在插入时候写入当前时间戳
        );
		$Sort=M('User');
		if($_POST['nickname']==-1) $this->error('所属分组:请选择分组');
		if ($Sort->validate($rules)->auto($rules1)->create()){
			if($_POST['account']!==$_POST['username']){
				$map['account']=$_POST['account'];
				$count1=$Sort->where($map)->count();
				if($count1>0){
					$this->error('用户名已存在');
				}
			}
			if($_POST['email']!==$_POST['hideemail']){
				$map['email']=$_POST['email'];
				$count2=$Sort->where($map)->count();
				if($count2>0){
					$this->error('邮箱已存在');
				}
			}			
			if(false !== $Sort->save()){
				$result = $Sort->execute("update yulin_role_user set role_id='$_POST[nickname]' where role_id='$_POST[roleid]' and user_id='$_POST[id]'");
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
           
        }else{
			$this->error($Sort->getError());
        }
    }

    public function personaledit($id=0) {
		$Edit=M('User');
		$con['id']=$_SESSION['yulin_uid'];	
		$edit=$Edit->where($con)->find();
		//print_r($edit);
		$this->assign('edit',$edit);		
        $this->display();
    }	
	
	public function del(){
        $Attach=M(MODULE_NAME);
		if(isset($_REQUEST['id'])){
		    $con['id'] = $_REQUEST['id'];
			if($Attach->where($con)->delete()){
			    $this->success('删除成功');
		    }else{
			    $this->error('删除失败');
		    }			
		}
		if(!empty($_POST['aids'])){
			$aid=$_POST['aids'];
			//$this->success($aids[1]);
			$aids=explode('YIPU',$aid);
			if(is_array($aids)){
				foreach($aids as $k=>$v){
					$con['id']=$v;
					$Attach->where($con)->delete();	
				}
				$this->success('删除成功');
			}
		}else{
			$this->error('你没有选择任何选项');
		}
	}
}
?>