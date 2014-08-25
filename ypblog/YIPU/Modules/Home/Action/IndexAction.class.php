<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommonAction {
    public function index(){
		$archivelist=$this->showlistYIPU('Archive',array('status'=>2),'id desc','5');
		$this->assign('archivelist',$archivelist);
		$this->display();
	}
}