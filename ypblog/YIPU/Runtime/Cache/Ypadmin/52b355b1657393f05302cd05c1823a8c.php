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
<div id="t1">
<div id="admindex">
<div id="admindex_servinfo">
<h3>服务器信息</h3>
<ul>
<?php if(is_array($serverinfo)): $i = 0; $__LIST__ = $serverinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><div style="width:40%; float:left"><?php echo ($key); ?>:</div><div style="float:left"><?php echo ($v); ?></div><div style="clear:both"></div></li><?php endforeach; endif; else: echo "" ;endif; ?>    
</ul>

</div>

<div id="admindex_msg">
<h3>信息统计</h3>
<ul>
	<li><div style="width:40%; float:left">登录用户：</div><div style="float:left"><?php if($username != null ): echo ($username); ?>&nbsp;&nbsp;(<?php echo ($user); ?>)<?php else: ?>顶级管理员&nbsp;&nbsp;(admin)<?php endif; ?></div><div style="clear:both"></div></li>
    <li><div style="width:40%; float:left">最后登录时间：</div><div style="float:left"><?php echo (date("Y-m-d G:i:s",$lastlogintime)); ?></div><div style="clear:both"></div></li>
    <li><div style="width:40%; float:left">最后登录IP：</div><div style="float:left"><?php echo ($lastloginip); ?></div><div style="clear:both"></div></li>
    <li><div style="width:40%; float:left">登录次数：</div><div style="float:left"><?php echo ($logincount); ?>&nbsp;次</div><div style="clear:both"></div></li>    
    <li><div style="width:40%; float:left">操作系统：</div><div style="float:left"><?php echo ($Os); ?></div><div style="clear:both"></div></li>
    <li><div style="width:40%; float:left">浏览器：</div><div style="float:left"><?php echo ($Browser); ?></div><div style="clear:both"></div></li>
    <li><div style="width:40%; float:left">浏览器语言：</div><div style="float:left"><?php echo ($Browserlan); ?></div><div style="clear:both"></div></li>
     <li><div style="width:40%; float:left; height:79px;"></div><div style="clear:both"></div></li>
    <li style=" height:50px"><div style="width:40%; float:left"><iframe src="http://weather.17oh.com/weather.php" width="168" height="50" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe></div></li>
<!--    <li><div style="width:40%; float:left">访客真实IP：</div><div style="float:left"><?php echo ($ip); ?></div><div style="clear:both"></div></li>
    <li><div style="width:40%; float:left">本地真实IP：</div><div style="float:left"><?php echo ($ip1); ?></div><div style="clear:both"></div></li>
    <li><div style="width:40%; float:left">本次登录地点：</div><div style="float:left"><?php echo ($addres); ?></div><div style="clear:both"></div></li>-->
</ul>
<ul>

	
	
	
</ul>
</div>
<div class="clear"></div>
</div>
</div>
</td>
</tr></tbody></table>
<div style="border-top:1px solid #F0F0F0; padding:10px 0px; margin-top:10px"><p align="center">© 2011－2012 Powered by <a target="_blank" href="www.oscphp.com" target="_blank">怿朴</a> (www.oscphp.com) 怿朴的博客保留所有权利<br/>为了获得更好的用户体验，请使用高版本的浏览器，如谷歌、火狐等主流浏览器！</p></div>
</div>
</body>
</html>