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


class ArchiveAction extends CommonAction {
		
	public function _tigger_insert($tags,$id,$model) {
        $this->saveTag($tags,$id,$model);
	}

	public function _tigger_update($tags,$id,$model) {
        $this->saveTag($tags,$id,$model);
	}
    public function index($map=array(),$sortBy='',$asc=false){
		$User = M('Archive'); // 实例化Form对象
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
		if(!empty($_POST['catid']) && $_POST['catid'] != -1){
			$map['sortid']=$_POST['catid'];	
		}
		if(!empty($_POST['name'])){
			$map['title']=array('like','%'.$_POST['name'].'%');	
		}
		if(!empty($_POST['state']) && $_POST['state'] != -1){
			$map['status']=$_POST['state'];	
		}	
		if(!empty($_POST['type']) && $_POST['type'] != -1){
			$map['attribute']=$_POST['type'];	
		}						
        $count      = $User->where($map)->count();// 查询满足要求的总记录数
        $Page       = new Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
       
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $lists = $User->where($map)->order('clicks desc,attribute desc,paixu asc,'.$order.' '.$sort)->limit($Page->firstRow.','.$Page->listRows)->select(); 
		if(!empty($lists)){
		    foreach($lists as $key=>$value){
			    $Sort=M('Sort');
			    $con['id']=$value['sortid'];
			    $sort=$Sort->where($con)->field('name')->find();
				$amap['record_id']=$value['id'];
				$amap['module']=MODULE_NAME;
				$value['attach']=M('Attach')->where($amap)->count();
				$maps['review_id']=0;
				$maps['record_id']=$value['id'];
				$maps['module']=MODULE_NAME;
				$value['comment']=M('Comment')->where($maps)->count();
			    $value['sortname']=$sort['name'];
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
		$sorts=$this->getsort(MODULE_NAME);
		$this->assign('sorts',$sorts);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
	}	


		

}
?>