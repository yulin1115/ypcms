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
// | 页面创建时间: 2012-11-5
// +----------------------------------------------------------------------


class RoleAction extends CommonAction {
	
    public function index($map=array(),$sortBy='',$asc=false){
		$Role = M('Role');
		//print_r($User->getDbFields());				
        $lists = $Role->select(); 
		//print_r($list); 
        $this->assign('lists',$lists);// 赋值数据集
        $this->display(); // 输出模板
	}	

    public function add() {
        $this->display();
    }
	
    public function impower() {
		$Node=M('Node');
		$nodes=$Node->select();
		$nodetrees=genTree($nodes);
		$Access=M('Access');
		$con['role_id']=$_REQUEST['id'];
		$access=$Access->where($con)->select();
		if($access){
		    foreach($access as $accesstr){
			    $str.=$accesstr['node_id'].'.';
		    }
		}
        foreach($nodetrees as $k=>$v){
		    $nodetrees[$k]['access'] = $str;
            foreach ($v as $k1=>$v1){
                if(is_array($v1)){
                    foreach($v1 as $k2=>$v2){
                        $nodetrees[$k][$k1][$k2]['access'] = $str;
                        foreach ($v2 as $k3=>$v3){
                            if($k3 == "children" && is_array($v3)){
                                foreach ($v3 as $k4=>$v4){
								    $nodetrees[$k][$k1][$k2][$k3][$k4]['access'] =$str;
							    }
						    }
                        }
                    }
                }
            }
        }			
	
		//print_r($nodetrees);
		$this->assign('nodetrees',$nodetrees);
		$this->assign('access',$access);
        $this->display();
    }	

    public function replace(){
        $Access = M("Access");
	    $con['role_id']=$_POST['id'];
	    $access=$Access->where($con)->select();
	    if($access){
		    $Access->where($con)->delete();
	    }
	    $id=$_POST['aids'];
	    if(empty($id)){
		    $this->error('您没有选择操作');
	    }
	    if(is_array($id)) {
	        $actionIdList = implode(',',$id);
	    }
        $where = 'a.id ='.$_REQUEST['id'].' AND b.id in('.$actionIdList.')';
		$sql='INSERT INTO yulin_access (role_id,node_id,pid,level) SELECT a.id, b.id,b.pid,b.level FROM yulin_role a, yulin_node b WHERE '.$where;
        $result = $Access->execute($sql);
        if($result===false) {
            $this->error('授权失败');
        }else{
            $this->success('授权成功');
        }
	}
	
    public function edit($id=0) {
		$Edit=M('User');
		$con['id']=$id;	
		$edit=$Edit->where($con)->find();
		//print_r($edit);
		$this->assign('edit',$edit);	
        $this->display();
    }	

	public function del(){
        $Attach=M('Role');
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