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
		if(C('CONTROL')==0){
		$this->display('Public:open');
		exit();
		}
		$this->menu();
		$this->showTag();
		$this->assign('nickname',$_SESSION['nickname']);
		$this->assign('figureurl',$_SESSION['figureurl']);
	}


    public function menu(){
		$Menu=M('sort');
		$menu=$Menu->where('isnav=1')->select();
		$menus=genTree($menu);
		//print_r($menus);
		$this->assign('menus',$menus);
	}
	
    public function insert($success,$error) {
		$Sort=D(MODULE_NAME);
		if ($Sort->create()){
			$resule=$Sort->add();
			if($resule){
				$this->success($success);
			}else{
				$this->error($error);
			}
           
        }else{
			$this->error($Sort->getError());
        }
    }
	
    public function _empty(){
	    header("HTTP/1.0 404 Not Found");
        $this->display('Public:404'); 
	}
	
    public function showlistYIPU($module,$map,$order,$limit){
	    $Module=M($module);
		$YIPUlist=$Module->where($map)->order($order)->limit($limit)->select();
		//print_r($YIPUlist);
		foreach($YIPUlist as $k=>$v){
			$v['newcontent']=cutstr_html($v['content']);//怎家过滤html后的内容元素供列表显示
			if(!empty($v['tags'])){
			    $tagarray=explode(' ',$v['tags']);
				//print_r($tagarray);
				//$tagsarr=array();
				foreach($tagarray as $tagk=>$tagv){
					$tagsarr['name']=$tagv;
					$tagarray[$tagk]=$tagsarr;
					$v['taglist']=$tagarray;
				}
			}
			$YIPUlist[$k]=$v;
		}	
		return $YIPUlist;	
	}	
	
	public function showTag(){
		$taglist=$this->showlistYIPU('Tag','','count desc');
		$this->assign('taglist',$taglist);		
	}
	
	// 验证码显示
	public function verify()
    {
        import("@.ORG.Image");
        Image::buildImageVerify(4,1,'png', 80, 34, 'verify');
    }

}

?>