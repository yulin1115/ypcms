<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>YIPU.CMS</title>
<link href="__PUBLIC__/Ypadmin/css/style.css" type=text/css rel=stylesheet>
<link href="__PUBLIC__/Ypadmin/css/style1.css" type=text/css rel=stylesheet>
<link href="__PUBLIC__/Ypadmin/css/css-main.css" type=text/css rel=stylesheet> 
<script type="text/javascript" src="__PUBLIC__/Js/Window/ctunion.js"></script> 
<script type="text/javascript" src="__PUBLIC__/Ypadmin/jquery/jquery.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery.form.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Window/alertdiv.js"></script>
</head>
<body>
<div class="center">

<table id=header cellspacing=0 cellpadding=0 width="100%" border=0>
  <tbody>
  <tr>
    <td width="9" id="headerleft"></td>
    <td width="125"  class="logo" align="left"><a href="<?php echo U('Index/index');?>" title="返回管理首页"></a></td>
    <td class="vesion" width="400">欢迎:&nbsp;&nbsp;<?php echo ($user); ?>&nbsp;&nbsp;<img src="__PUBLIC__/Ypadmin/images/users.png" align="absmiddle" />&nbsp;&nbsp;<?php if($user == admin): ?>顶级管理员<?php else: echo ($username); endif; ?></SPAN></td>
    <td  class="home" align="left"><a href="../" target="_blank" title="在新窗口浏览我的blog">
    
    </a></td>
    <td align=right nowrap class="headtext">
    <div style=" height:40px; line-height:40px;">
    <img src="__PUBLIC__/Ypadmin/images/home.gif" align="absmiddle" />
    <a href="<?php echo U('/Index/index');?>" target="_blank">返回首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;
    <img src="__PUBLIC__/Ypadmin/images/reload.gif" align="absmiddle" />
	<a href="<?php echo U('User/personaledit');?>">修改密码</a>&nbsp;&nbsp;|&nbsp;&nbsp;    
    <img src="__PUBLIC__/Ypadmin/images/revert.gif" align="absmiddle" />
	<a href="db" >数据库备份</a>&nbsp;&nbsp;|&nbsp;&nbsp;
    <img src="__PUBLIC__/Ypadmin/images/reload.gif" align="absmiddle" />
	<a href="admin.php?inc=main&action=writeCache">更新缓存</a>&nbsp;&nbsp;|&nbsp;&nbsp;
    <img src="__PUBLIC__/Ypadmin/images/refresh.png" align="absmiddle" />
	<a href="javascript:window.location.reload();">刷新</a>&nbsp;&nbsp;|&nbsp;&nbsp;
    <img src="__PUBLIC__/Ypadmin/images/back.gif" align="absmiddle" />
    <a href="javascript:history.go(-1);">返回</a>&nbsp;&nbsp;|&nbsp;&nbsp;	
    <img src="__PUBLIC__/Ypadmin/images/home.gif" align="absmiddle" />
    <a href="<?php echo U('Public/logout');?>" target="_self">退出</a>&nbsp;&nbsp;&nbsp;&nbsp;	
    </div>
    </td>
    <td width="9" id="headerright" ></td>
	</tbody>
</table>
<SCRIPT LANGUAGE="JavaScript">

function ajaxs_del(){
	var btns=[
		{value:" 确 认 ",onclick:"dels()",focus:true},
		{value:" 取 消 ",onclick:"popwin.close()"}
	];
	popwin.showDialog(3,"确认","您选择了批量操作，该操作的完成可能需要等待一些时间。<br />是否确认继续？",btns,320,130);
}
function ajax_del(id){
	var btns=[
		{value:" 确 认 ",onclick:"del("+id+")",focus:true},
		{value:" 取 消 ",onclick:"popwin.close()"}
	];
	popwin.showDialog(3,"确认","您选择了单个删除操作，你真的要删除文档吗。<br />是否确认继续？",btns,320,130);
}
function dels(){
    var userValue = "";
    $("input[name='aids']").each(function(i) {
        if ($(this).attr("checked")) {
            userValue += $(this).val() + "YIPU";
        }
    });
	userValue = userValue.substring(0, userValue.length - 1);
	   //alert(userValue);
    $.post("<?php echo U('del');?>",{aids:userValue},complete); 
	popwin.close();
}

function del(id){
    $.get("<?php echo U('del');?>",{id:id},complete); 
    popwin.close();
}
function complete(data){
    if (data.status==1){
        showMessage(data.info,4000,211,111,'dui');
		setTimeout("window.location = '<?php echo U('index');?>'",3000);
    }else{
        showMessage(data.info,4000,211,111,'cuo');
    }
}
function ajaxs_pass(){
	var userValue = "";
    $("input[name='aids']").each(function(i) {
        if ($(this).attr("checked")) {
           userValue += $(this).val() + "YIPU";
        }
    });
	userValue = userValue.substring(0, userValue.length - 1);
    $.post("<?php echo U('pass');?>",{id:2,aids:userValue},complete); 
}
function ajaxs_nopass(){
	var userValue = "";
    $("input[name='aids']").each(function(i) {
        if ($(this).attr("checked")) {
           userValue += $(this).val() + "YIPU";
        }
    });
	userValue = userValue.substring(0, userValue.length - 1);
    $.post("<?php echo U('pass');?>",{id:1,aids:userValue},complete); 
}
</script>
<table cellspacing=0 cellpadding=0 width="100%" border=0>
<tbody >
  <tr>
<td valign=top align=left width="134">
    <div id=sidebartop></div>

	<table cellspacing=0 cellpadding=0 width="100%" border=0>
        <tbody>
        <tr>
          <td valign=top align=left width="134">
            <div id=sidebar>
            <div class="sidebarmenu" onclick="displayToggle('m_', 1);">系统模块</div>
			<div id="">

            <!--根据用户权限输出模块-->
            <?php if(is_array($menu)): foreach($menu as $key=>$module1): if($module1["type"] == 2 ): ?><div class="sidebarsubmenu" id="menu_wt"><a href="<?php echo U(''.$module1['name'].'/index');?>"><?php echo ($module1["title"]); ?></a></div><?php endif; endforeach; endif; ?>
            <!--根据用户权限输出模块-->

			</div>
			</div>
       	    </td>
		  </tr>
		</tbody>
	</table>

    <table cellspacing=0 cellpadding=0 width="100%" border=0>
        <tbody>
        <tr>
          <td valign=top align=left width="114">
            <div id=sidebar>
            <div class="sidebarmenu" onclick="displayToggle('m_added', 1);">安装模块</div>
			<div id="m_added">
            <!--根据用户权限输出模块-->
            <?php if(is_array($menu)): foreach($menu as $key=>$module2): if($module2["type"] == 1 ): ?><div class="sidebarsubmenu" id="menu_wt"><a href="<?php echo U(''.$module2['name'].'/index');?>"><?php echo ($module2["title"]); ?></a></div><?php endif; endforeach; endif; ?>
            <!--根据用户权限输出模块-->
			</div>
			</div>
       	    </td>
		  </tr>
		</tbody>
	</table>
	<div id="sidebarBottom"></div>
</td>    
<td id=container valign=top align=left>
<!--加载各个模块main部分-->
<div id="t1">
    <form id="dataForm" method="post" action="<?php echo U('Archive/index');?>">
    <div class="tt">查询筛选</div>
    <table cellpadding="2" cellspacing="1" class="tb">
	<tr>
	<td style="padding:5px">
    <div style="width:40%; float:left; line-height:">
    <a class="td_5_1a" href="<?php echo U('add');?>"><img src="__PUBLIC__/Ypadmin/images/icon_add.gif"   class="imgpt4"/> <span class="">添加资讯</span></a>&nbsp;&nbsp;
    <a class="td_5_1a" href="javascript:ajaxs_del()"><img src="__PUBLIC__/Ypadmin/images/close.gif"   class="imgpt4"/> <span class="">删除资讯</span></a>&nbsp;&nbsp;
    <a class="td_5_1a" href="javascript:ajaxs_pass()"><img src="__PUBLIC__/Ypadmin/images/pass.png"   class="imgpt4"/> <span class="">审核通过</span></a>&nbsp;&nbsp;
    <a class="td_5_1a" href="javascript:ajaxs_nopass()"><img src="__PUBLIC__/Ypadmin/images/nopass.png"   class="imgpt4"/> <span class="">继续审核</span></a>
    </div>
    <input type="hidden" value="" id="cid" />
	<div align="center" id="searchs" style="float:right"> 
        <span style="float:left">
        <select name="catid" id="select" style="width:160px;">
        <option value="-1">分类筛选</option>
        <?php if(is_array($sorts)): foreach($sorts as $key=>$sort): ?><option value="<?php echo ($sort["id"]); ?>"><?php echo ($sort["cname"]); ?></option><?php endforeach; endif; ?>
        </select>
        </span>
        <span style="float:left; margin-left:10px;">
        <select name="type" id="attribute" style="width:50px;">
        <option value="-1">级别</option>
        <option value="0">正常</option>
        <option value="1">首页</option>  
        <option value="2">置顶</option>   
        </select>
        </span>
        <span style="float:left; margin-left:10px;">
        <select name="state" id="status" style="width:50px;">
        <option value="-1">状态</option>
        <option value="2">通过</option>
        <option value="1">待审</option>
        </select>
        </span>        
   	    <span style="font-weight:bold; margin-left:10px; float:left; border-right:2px dotted #CCC; padding-right:10px">
        	<input class="cxinputs" type="text"  value="" id="name" name="name"  style="height:17px; width:110px;"/>
        </span>
        <span style="float:left ; margin-left:10px;"><input id="search-submit" style=" border:0px; height:21px;width:28px;cursor:pointer;" type="submit"  value=""></span>
    	<div style="clear:both"></div>
     </div>
    </td>
	</tr>
	</table>
	<div class="div_clear" style="height:10px;"></div>
	<table cellpadding="2" cellspacing="1" class="tb" id="contentTb">
	<tr>
	<th><input type="checkbox" onclick="selectall(this.checked)" class="checkbox_css" /></th>
	<th>ID</th>
	<th>排序</th>
	<th>标题</th>
	<th>分类</th>
	<th>级别</th>
    <th>状态</th>
	<th>点击</th>
    <th>附件</th>
    <th>评论</th>
	<!--<th>作者</th>
	<th>更新时间</th>-->
	<th>操作</th>
	</tr>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr onmouseover="this.className='on';" onmouseout="this.className='';" align="">
	<td width="30px"><input class="checkbox_css" type="checkbox" name="aids" value="<?php echo ($list["id"]); ?>"></td>
	<td width="50px"><?php echo ($list["id"]); ?></td>
	<td width="50px">
	<input type="text" size="6" value="<?php echo ($list["paixu"]); ?>" name="ordernum[]" class="text_css" />                          
	</td>
	<td style="color:<?php echo ($list["style"]); ?>; width:280px"><?php echo ($list["title"]); ?></td>
	<td><?php echo ($list["sortname"]); ?></td>
	<td><?php if($list["attribute"] == 0 ): ?>正常<?php elseif($list["attribute"] == 1): ?><font color="#2a9ddb">首页</font><?php elseif($list["attribute"] == 2): ?><font color="#003366">置顶</font><?php endif; ?></td>
    <td><?php if($list["status"] == 2 ): ?>通过<?php elseif($list["status"] == 1): ?><font color="#999999">待审...</font><?php endif; ?></td>
    <td><?php echo ($list["clicks"]); ?></td>
    <td><a href="<?php echo U('Attach/index/',array('module'=>$Think.MODULE_NAME,'id'=>$list['id']));?>">查看(<?php echo ($list["attach"]); ?>)</a></td>
    <td><a href="<?php echo U('Comment/index/',array('module'=>$Think.MODULE_NAME,'record_id'=>$list['id']));?>">查看(<?php echo ($list["comment"]); ?>)</a></td>
	<td style="vertical-align:middle">
	<a href="<?php echo U('edit/',array('id'=>$list['id']));?>"><img src="__PUBLIC__/Ypadmin/images/addblog.gif" align="absmiddle" title="编辑"/></a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="javascript:ajax_del(<?php echo ($list["id"]); ?>)"><img src="__PUBLIC__/Ypadmin/images/close.gif" align="absmiddle" title="删除"/></a>
	</td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>

	</table>
	<div class="div_clear" style="height:10px;"></div>
    <table cellpadding="0" cellspacing="0" class="tb">
    <tr><td class="page"><?php echo ($page); ?></td></tr>
    </table>
	</form>
    </div>
	<script>
	
	
	/* 
	 * 全选
	 * @Author (CX)残雪易冷
	 */
	function selectall(b){
		var oForm=document.getElementById("dataForm");
		for (var i = 0; i < oForm.elements.length; i++) {
			if(oForm.elements[i].type=="checkbox"&&!oForm.elements[i].disabled){
				oForm.elements[i].checked = b;
			}
		}
	}
	</script>
	





</td>
</tr></tbody></table>
<div style="border-top:1px solid #F0F0F0; padding:10px 0px; margin-top:10px"><p align="center">© 2011－2012 Powered by <a target="_blank" href="www.oscphp.com" target="_blank">怿朴</a> (www.oscphp.com) 怿朴的博客保留所有权利<br/>为了获得更好的用户体验，请使用高版本的浏览器，如谷歌、火狐等主流浏览器！</p></div>
</div>
</body>
</html>