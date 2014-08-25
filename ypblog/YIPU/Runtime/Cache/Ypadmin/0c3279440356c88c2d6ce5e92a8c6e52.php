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

<style>
select{width:210px}
</style>
<SCRIPT LANGUAGE="JavaScript">
 $(function(){
        $('#configupdate').ajaxForm({
            beforeSubmit:  checkForm,  // pre-submit callback
            success:       complete,  // post-submit callback
            dataType: 'json'
        });
        function checkForm(){

        }
        function complete(data){
            if (data.status==1){
                showMessage(data.info,4000,211,111,'dui');
				//window.location = "<?php echo U('index');?>";
				setTimeout("window.location = '<?php echo U('index');?>'",3000);
				
                // 更新列表
            }else{
                showMessage(data.info,4000,211,111,'cuo');
            }
        }

    });
</script>
<div id="smalltab_container"></div>
	<div class="smalltab_line"></div>
	<div id="t1">
	<div class="tt">注意事项</div>
	<table cellpadding="2" cellspacing="1" class="tb">
	<tr>
	<td>&nbsp;&nbsp;&nbsp;1、上传图片后如想重新上传,请先删除上传的饿图片,以免无用图片的堆积!</td>
	</tr>
	</table>
	<div class="div_clear" style="height:10px;"></div>
    <form id="configupdate" method='post' action="<?php echo U('configupdate');?>">
    <input type="hidden" name="ajax" value="1">
	<div class="tt">基本信息</div>
	<table cellpadding="2" cellspacing="1" class="tb" id="tablebg">
    <?php if(is_array($config)): $i = 0; $__LIST__ = $config;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$config): $mod = ($i % 2 );++$i;?><tr >
	<td class="tl"><?php echo ($config["name"]); ?>:</td>
	<td id="catid" class="t2"><input type="text" size="10" id="inputs2" name="config[<?php echo ($config["name"]); ?>]"   value="<?php echo ($config["value"]); ?>" /></td>
	<td class="t2"><?php echo ($config["remark"]); ?></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>       
	</table>
	<div class="div_clear" style="height:10px;"></div>
	<input class="button_css" type="submit" name="submit" id="submit" value="更  新" />
	</form>
	</div>
	
	<div id="t2"></div>
	<div id="t3"></div>
	


</td>
</tr></tbody></table>
<div style="border-top:1px solid #F0F0F0; padding:10px 0px; margin-top:10px"><p align="center">© 2011－2012 Powered by <a target="_blank" href="www.oscphp.com" target="_blank">怿朴</a> (www.oscphp.com) 怿朴的博客保留所有权利<br/>为了获得更好的用户体验，请使用高版本的浏览器，如谷歌、火狐等主流浏览器！</p></div>
</div>
</body>
</html>