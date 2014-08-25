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
// | 页面创建时间: 2012-10-17
// +----------------------------------------------------------------------


class AttachAction extends CommonAction {
	
		

    public function index(){
		$Attach=M('Attach');
		$con['record_id']=$_REQUEST['id'];
		$con['module']=$_REQUEST['module'];
		$list=$Attach->where($con)->select();
		//print_r($list);
		$this->assign('list',$list);
        $this->display(); // 输出模板
	}

	
	public function del(){
        $Attach=M('Attach');
		if(isset($_REQUEST['id'])){
		    $con['id'] = $_REQUEST['id'];
		    $picurl=$Attach->where($con)->field('savename,savepath')->find();
			if(file_exists($picurl['savepath'].$picurl['savename'])){
				unlink($picurl['savepath'].$picurl['savename']);
			}			
		    if(file_exists($picurl['savepath'].'m_'.$picurl['savename'])&&file_exists($picurl['savepath'].'s_'.$picurl['savename'])){
			    unlink($picurl['savepath'].'m_'.$picurl['savename'])&&unlink($picurl['savepath'].'s_'.$picurl['savename']);
		    }
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
					$picurl=$Attach->where($con)->field('savename,savepath')->find();
					if(file_exists($picurl['savepath'].$picurl['savename'])){
						unlink($picurl['savepath'].$picurl['savename']);
					}					
		            if(file_exists($picurl['savepath'].'m_'.$picurl['savename'])&&file_exists($picurl['savepath'].'s_'.$picurl['savename'])){
			            unlink($picurl['savepath'].'m_'.$picurl['savename'])&&unlink($picurl['savepath'].'s_'.$picurl['savename']);			            				    
					}
					$Attach->where($con)->delete();	
				}
				$this->success('删除成功');
			}
		}else{
			$this->error('你没有选择任何选项');
		}
	}	
		

	public function _upload_init($upload) {
		$upload->thumb              = true;
		
        // 设置引用图片类库包路径
        $upload->imageClassPath     = '@.ORG.Image';
        //设置需要生成缩略图的文件后缀
        $upload->thumbPrefix        = C('THUMB_PREFIX');  //生产2张缩略图，若这里改动，删除附件的地方也需要手动改动一下
        //设置缩略图最大宽度
        $upload->thumbMaxWidth      = C('THUMB_MAX_WIDTH');
        //设置缩略图最大高度
        $upload->thumbMaxHeight     = C('THUMB_MAX_HEIGHT');
        //设置上传文件规则
        $upload->saveRule           = 'uniqid';
//		$upload->autoSub=true;
//		$upload->subType = 'date';
        //删除原图
        $upload->thumbRemoveOrigin  = true;
        //覆盖相同名称的图片
        $upload->uploadReplace  = true;		
        //设置上传文件大小
        $upload->maxSize            = C('MAX_SIZE');

        //设置上传文件类型
		$allow=C('ALLOW_EXTS');
        $upload->allowExts          = explode(',', $allow);
		$module=$_POST['_uploadFileTable'];
        $upload->savePath =  'Public/Upload/'.date('Ymd').'/';
		
        return $upload;
    }

	public function uploads(){
		$this->upload();
	
	}

}
?>