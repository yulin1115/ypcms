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
// | 页面创建时间: 2012-09-24
// +----------------------------------------------------------------------


class SortAction extends CommonAction {

    public function index(){
		$Module=M('Module');
		$module=$Module->select();
		$con['moduleid']=$_REQUEST['mid']?$_REQUEST['mid']:$module[0]['id'];
//		$List=M('Sort');
//		$list=$List->where($con)->select();
//		$list=$List->where($con)->field("id,name,pid,path,concat(path,'-',id) as bpath")->order("bpath ASC")->select();
//		foreach($list as $key=>$value){
//			$list[$key]['count'] = count(explode('-',$list[$key]['bpath']));
//		}
//		foreach($list as $key=>$value){
//			for($i=0;$i<$list[$key]['count']*3;$i++){
//				$str.="›";
//			}
//			$list[$key]['nname'] = $str."|".$list[$key]['name'];
//			$str='';
//		}
//		
		
        import("@.ORG.Tree");
        $cat = new Tree('Sort', array('id', 'pid', 'name', "cname"));
        $list = $cat->getList($con); //获取分类结构		
		//print_r($list);
		
//		import("@.ORG.Tree");// 导入分页类
//		$tree=new Tree($list);
//        $html=$tree->getArray($myid=0,$sid = 0, $adds ='');	
//		print_r($html);
		$this->assign('module',$module);		
		$this->assign('list',$list);
		$this->display();
	}	

    public function sortadd() {
		$module=M('Module');
		$modules	=	$module->field('id,name')->order('id asc')->select();//查询模型
		$kindeditor=editor("content","content","700","500","");//加载编辑器
		$this->assign('editor',$kindeditor);
		$this->assign('modules',$modules);
        $this->display();
    }
	
    public function sortinsert() {

		$Sort=D('Sort');
		if ($Sort->create()){
			if($Sort->add()){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
           
        }else{
			$this->error($Sort->getError());
        }
    }
	
    public function sortedit() {
		$Module=M('Module');
		$modules	=	$Module->order('id asc')->select();//查询模型
		//print_r($modules);
		$Sort=M('Sort');
		$id = $_REQUEST['id'];
		$sorts=$Sort->find($id);
		$Singlepage=M('Singlepage');
		$singlepage=$Singlepage->where('status=2')->select();
		$kindeditor=editor("content","content","700","500",$sorts['content']);//加载编辑器
		$this->assign('sorts',$sorts);
		$this->assign('editor',$kindeditor);
		$this->assign('modules',$modules);
		$this->assign('module',$modules);
		$this->assign('singlepage',$singlepage);
        $this->display();
    }	
}
?>