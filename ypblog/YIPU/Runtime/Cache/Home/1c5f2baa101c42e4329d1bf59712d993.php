<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta property="qc:admins" content="755672634767330006375" />
<meta property="qc:admins" content="755672634767330006375" />
<meta name="keywords" content="<?php if($read["keywords"] == ''): echo (C("KEYWORDS")); else: echo ($read["keywords"]); endif; ?>" />
<meta name="description" content="<?php if($read["description"] == ''): echo (C("DESCRIPTION")); else: echo ($read["description"]); endif; ?>" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>
<?php if(MODULE_NAME== 'Tag'): echo (ACTION_NAME); ?>_热门标签_<?php echo (C("WEBNAME")); endif; ?>
<?php if((MODULE_NAME== 'Archive') and ($read["title"] != null) ): echo ($read["title"]); ?>_WEB开发_<?php echo (C("WEBNAME")); endif; ?>
<?php if((MODULE_NAME== 'Archive') and ($read["title"] == null) ): echo (ACTION_NAME); ?>_WEB开发_<?php echo (C("WEBNAME")); endif; ?>
<?php if(MODULE_NAME== 'Index'): echo (C("WEBTITLE")); endif; ?>
<?php if(MODULE_NAME== 'Message'): ?>留言_<?php echo (C("WEBNAME")); endif; ?>
<?php if((MODULE_NAME== 'Photo')): echo (ACTION_NAME); ?>_珍贵影像_<?php echo (C("WEBNAME")); endif; ?>
</title>
<link href="__PUBLIC__/Home/css/style.css" type=text/css rel=stylesheet>
<link href="__PUBLIC__/Css/SyntaxHighlighter/shCore.css" type=text/css rel=stylesheet>
<link href="__PUBLIC__/Css/SyntaxHighlighter/shThemeDefault.css" type=text/css rel=stylesheet>
<?php if(MODULE_NAME!= Photo): ?><!--这里来个判断，因为下面的js跟瀑布流布局的js有冲突，所以判断下瀑布流显示的页面不加载下面的js-->
<script type="text/javascript" src="__PUBLIC__/Js/config.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/SyntaxHighlighter/shCore.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/SyntaxHighlighter/shAutoloader.js"></script><?php endif; ?>
<?php if(MODULE_NAME== Photo): ?><!--瀑布流需要的jquery跟置顶特效需要的jquery不一样所以这里也判断下-->
<script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery-1.7.2.min.js"></script><?php endif; ?>
<?php if(MODULE_NAME!= Photo): ?><!--瀑布流需要的jquery跟置顶特效需要的jquery不一样所以这里也判断下-->
<script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery.min.js"></script><?php endif; ?>
<script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery.form.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Window/alertdiv.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/top/gotop.js"></script>
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
	<div id="header">
		<div id="logo">
			<div style="font-size: 3.4em;letter-spacing: -1px; float:left; width:45%"><a href="http://www.oscphp.com">怿朴的博客</a></div>
            <div style="width:50%; float:right; text-align:right; font-size:18px; color:#FFF">生活就是这样.点点滴滴<p><div style="font-size:15px">——&nbsp;&nbsp;&nbsp;<?php if($nickname != null): ?><img  align="absmiddle" src="<?php echo ($figureurl); ?>" width="20" height="20"  /></a>&nbsp;&nbsp;<?php echo ($nickname); ?>&nbsp;&nbsp;(<a href="<?php echo U('Qq/qqoutlogin');?>?backurl=<?php echo (str_replace("/index.php","",$_SERVER['PHP_SELF'])); ?>">安全退出</a>)<?php else: ?>怿朴&nbsp;<a href="<?php echo U('Qq/qqlogin');?>?backurl=<?php echo (str_replace("/index.php","",$_SERVER['PHP_SELF'])); ?>"><img  align="absmiddle" src="__PUBLIC__/Home/images/image/Connect_logo_7.png"  /></a><?php endif; ?></div></p></div>
		</div>
	</div>
	</div>
	<!-- end #header -->    
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		<div id="content">
        
        
        
        
        <div id="ifocus">
	<div id="ifocus_pic">
		<div id="ifocus_piclist" style="left:0; top:0;">
			<ul>
				<li><a href="" target="_blank"><img src="__PUBLIC__/Home/images/01.jpg" alt="" /></a></li>
				<li><a href="" target="_blank"><img src="__PUBLIC__/Home/images/02.jpg" alt="" /></a></li>
				<li><a href="" target="_blank"><img src="__PUBLIC__/Home/images/03.jpg" alt="" /></a></li>
				<li><a href="" target="_blank"><img src="__PUBLIC__/Home/images/04.jpg" alt="" /></a></li>
			</ul>
		</div>
		<div id="ifocus_opdiv"></div>
		<div id="ifocus_tx">
			<ul>
				<li class="current"> 世博去外滩耍，差点错过站，还好老大妈热情提醒啊</li>
				<li class="normal"> 以前上班的地方无锡，谁知道是哪里啊，给我留言</li>
				<li class="normal"> 一天半小玩北京，腿废了，据说这是用来加压让十二兽首喷水的</li>
				<li class="normal"> 白娘子，我来救你了</li>
			</ul>
		</div>
	</div>
	<div id="ifocus_btn">
		<ul>
			<li class="current"><img src="__PUBLIC__/Home/images/btn_01.jpg" alt="" /></li>
			<li class="normal"><img src="__PUBLIC__/Home/images/btn_02.jpg" alt="" /></li>
			<li class="normal"><img src="__PUBLIC__/Home/images/btn_03.jpg" alt="" /></li>
			<li class="normal"><img src="__PUBLIC__/Home/images/btn_04.jpg" alt="" /></li>
		</ul>
	</div>
</div>






      <?php if(is_array($archivelist)): foreach($archivelist as $key=>$archivelist): ?><div class="post">
				<h2 class="title"><a href="<?php echo U('Archive/'.$archivelist['id']);?>"><?php echo ($archivelist["title"]); ?></a></h2>
			<div class="meta">
            <span class="date">Publish by 怿朴 <?php echo (mdate($archivelist["creattime"])); ?></span>
            <span class="posted" style="height:24px;  width:200px;">
                <?php if($archivelist['taglist']): if(is_array($archivelist['taglist'])): foreach($archivelist['taglist'] as $key=>$taglistinfo): ?><li style="float:right; height:24px">
                    <a class="tag" title="<?php echo ($taglistinfo["name"]); ?>" href="<?php echo U('Tag/'.$taglistinfo['name']);?>"><?php echo ($taglistinfo["name"]); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;                 
                    </li><?php endforeach; endif; ?>
                    <div style=" clear:both"></div><?php endif; ?>             
            </span>            
            </div>
	  <div style="clear: both;"></div>
				<div class="entry">
                    <?php echo (msubstr($archivelist["newcontent"],0,130,'utf-8',true)); ?>
				</div>
                <div class="links"><a href="<?php echo U('Archive/'.$archivelist['id']);?>">Read More</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo U('Archive/'.$archivelist['id'].'#review');?>">Comments</a></div>
			</div><?php endforeach; endif; ?> 
    

		<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
<style>
a.tag {
	 float:left;
	background-color: #E0EAF1;
    border-bottom: 1px solid #3E6D8E;
    border-right: 1px solid #7F9FB6;
    color: #3E6D8E;
    font-size: 8pt;
    -webkit-text-size-adjust:none;
    margin: 0px 3px 4px 0;
    padding: 2px 4px;
    text-decoration: none;
    white-space: nowrap;
	height:14px; line-height:14px;
}
a.tag em {font-style:normal;color:#666;font-size:7pt; margin-left:2px;}
a.tag:hover {background-color:#3E6D8E;color:#fff; text-decoration:none}
a.tag:hover em {color:#fff;}
.Tags a.project {background-color: #cfc; color:#060;}
.Tags a.project:hover {background-color:#40AA53;color:#fff;}
</style>
        <div id="sidebar">
			<ul>
				<li>
					<div id="search" >
					<form method="post" action="<?php echo U('Archive/search');?>">
						<div>
							<input type="text" name="search" id="search-text" value="" />
							<input type="submit" id="search-submit" value="GO" />
						</div>
					</form>
					</div>
					<div style="clear: both;">&nbsp;</div>
				</li>
                <!--一类开始--><?php if(is_array($menus)): foreach($menus as $key=>$menus1): ?><li>
					<h2><?php if($menus1["pointmodule"] != null ): ?><a href="<?php echo U(''.$menus1['pointmodule'].'/'.$menus1['url']);?>"><?php echo ($menus1["name"]); ?></a><?php else: echo ($menus1["name"]); endif; ?> </h2>
                    <!--判断是否有子类开始-->
                    <?php if($menus1["children"] ): ?><ul>
                    <!--二类开始--><?php if(is_array($menus1['children'])): foreach($menus1['children'] as $key=>$menus2): ?><li><a href="<?php echo U(''.$menus2['pointmodule'].'/'.$menus2['url']);?>"><?php echo ($menus2["name"]); ?></a></li>
                                                          <?php if($menus2["children"] ): ?><!--二类开始--><?php if(is_array($menus2['children'])): foreach($menus2['children'] as $key=>$menus3): ?><li>└ <a href="<?php echo U(''.$menus3['pointmodule'].'/'.$menus3['url']);?>"><?php echo ($menus3["name"]); ?></a></li>
                    <!--二类开始--><?php endforeach; endif; endif; ?>
                    <!--二类开始--><?php endforeach; endif; ?>
					</ul>
                    <?php else: ?>
                    <!--判断是否有子类结束-->
					
                    <?php if($menus1["content"] != null ): ?><p>
                    <?php echo ($menus1["content"]); ?>
                    </p>
                    <?php else: ?>
                    <div style="width:215px; margin-left:25px;">
                    <ul>
                    <?php if(is_array($taglist)): foreach($taglist as $key=>$taglist): ?><a class="tag" title="<?php echo ($taglist["name"]); ?>" href="<?php echo U('Tag/'.$taglist['name']);?>"><?php echo ($taglist["name"]); ?><em>(<?php echo ($taglist["count"]); ?>)</em></a><?php endforeach; endif; ?>
                    <div style=" clear:both"></div>  
                    </ul>
                    </div><?php endif; endif; ?>
                </li>
                <!--一类结束--><?php endforeach; endif; ?>
<!--				<li>
					<h2> <a href="#">模块0</a> </h2>
					<ul>
						<li><a href="#"><?php echo ($Activities["title"]); ?></a></li>

					</ul>
				</li>
				<li>
					<h2>模块1</h2>
					<ul>
  
						<li><a href="#"><?php echo ($Blogroll["title"]); ?></a></li>

					</ul>
				</li>
				<li>
					<h2><a href="#">模块2</a></h2>
					<ul>

						<li><a href="#"><?php echo ($Archives["title"]); ?></a></li>
   
					</ul>
				</li>
                <li>
					<h2> <a href="#">模块3</a>  </h2>
					<p>人人尽说江南好，游人只合江南老。 春水碧于天，画船听雨眠。垆边人似月，皓腕凝霜雪。未老莫还乡，还乡须断肠。</p>
				</li>
                <li>
					<h2> <a href="#">模块4</a>   </h2>
					<p>如果您有什么好的建议，或者您有什么问题，请您给我留言，或者直接QQ联系我，谢谢。</p>
				</li>  -->              
                
			</ul>
		</div> 
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	</div>
	</div>
	<!-- end #page -->
    	<div id="footer">
       <div style=" width:100%; text-align:center; margin-top:10px;">
       <ul style="text-align:center; margin-left:0px; margin-bottom:0px; padding-left:0px;">
        <li style=" margin-left:10px; display:inline; color:#8A8A8A">友情链接：</li>
        <li style=" margin-left:10px; display:inline"><a href="http://www.welwm.com/" target="_blank">我饿啦外卖</a></li>
        <li style=" margin-left:10px;display:inline"><a href="http://www.php100.com/" target="_blank">PHP100中文网</a></li>
        <li style=" margin-left:10px;display:inline"><a href="http://www.oschina.net/" target="_blank">开源中国社区</a></li>
        <li style=" margin-left:10px;display:inline"><a href="http://www.youku.com/" target="_blank">优酷</a></li>
        <li style= "margin-left:10px;display:inline"><a href="http://www.bbstc.cn/" target="_blank">烟雨江南</a></li>
        <li style=" margin-left:10px;display:inline"><a href="http://www.3736.net/" target="_blank">江南大学山起山落</a></li>
        <div style=" clear:both"></div>
        </ul>
        </div>
		<p style=" padding-top:10px;">Copyright (c) 2012 woela.tk. All rights reserved. Design by 怿朴.</p>
        <p style=" padding-top:10px;"><a href="http://wpa.qq.com/msgrd?V=1&Uin=719655143&Site=怿朴&Menu=yes" target="_blank"><img src="http://wpa.qq.com/pa?p=1:719655143:5" alt="点击这里给我发送消息" border="0"></a>&nbsp;&nbsp; <script src="http://s94.cnzz.com/stat.php?id=4103667&web_id=4103667&show=pic" language="JavaScript"></script>&nbsp;&nbsp;<a href="http://webscan.360.cn/index/checkwebsite/url/www.oscphp.com" target="_blank"><img src="http://img.webscan.360.cn/status/pai/hash/6d60b0698e94c2d6b33861e17fdddabc" width="50" height="12" border="0"/></a></p>
	</div>
	<!-- end #footer -->
    </div>
    <?php if(MODULE_NAME!= Photo): ?><!--这里来个判断，因为下面的js跟瀑布流布局的js有冲突，所以判断下瀑布流显示的页面不加载下面的js-->
    <script type="text/javascript">
    SyntaxHighlighter.autoloader(
	'java            __PUBLIC__/Js/SyntaxHighlighter/shBrushJava.js',
	'php            __PUBLIC__/Js/SyntaxHighlighter/shBrushPhp.js',
	'html xml            __PUBLIC__/Js/SyntaxHighlighter/shBrushXml.js',
	'css            __PUBLIC__/Js/SyntaxHighlighter/shBrushCss.js',
	'js jscript javascript            __PUBLIC__/Js/SyntaxHighlighter/shBrushJScript.js',
	'bash shell            __PUBLIC__/Js/SyntaxHighlighter/shBrushPowerShell.js',
	'sql            __PUBLIC__/Js/SyntaxHighlighter/shBrushSql.js',
	'c-sharp csharp           __PUBLIC__/Js/SyntaxHighlighter/shBrushCSharp.js',
	'perl pl            __PUBLIC__/Js/SyntaxHighlighter/shBrushPerl.js',
	'py python            __PUBLIC__/Js/SyntaxHighlighter/shBrushPython.js',
	'vb vbnet            __PUBLIC__/Js/SyntaxHighlighter/shBrushVb.js',
	'cpp c            __PUBLIC__/Js/SyntaxHighlighter/shBrushCpp.js'
    );
    SyntaxHighlighter.all();
    </script><?php endif; ?>
</body>
</html> 
</div>
 
<style type="text/css">
/* Reset style */

</style>
<script type="text/javascript">
function $(id) { return document.getElementById(id); }

function addLoadEvent(func){
	var oldonload = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = func;
	} else {
		window.onload = function(){
			oldonload();
			func();
		}
	}
}
function moveElement(elementID,final_x,final_y,interval) {
  if (!document.getElementById) return false;
  if (!document.getElementById(elementID)) return false;
  var elem = document.getElementById(elementID);
  if (elem.movement) {
    clearTimeout(elem.movement);
  }
  if (!elem.style.left) {
    elem.style.left = "0px";
  }
  if (!elem.style.top) {
    elem.style.top = "0px";
  }
  var xpos = parseInt(elem.style.left);
  var ypos = parseInt(elem.style.top);
  if (xpos == final_x && ypos == final_y) {
		return true;
  }
  if (xpos < final_x) {
    var dist = Math.ceil((final_x - xpos)/10);
    xpos = xpos + dist;
  }
  if (xpos > final_x) {
    var dist = Math.ceil((xpos - final_x)/10);
    xpos = xpos - dist;
  }
  if (ypos < final_y) {
    var dist = Math.ceil((final_y - ypos)/10);
    ypos = ypos + dist;
  }
  if (ypos > final_y) {
    var dist = Math.ceil((ypos - final_y)/10);
    ypos = ypos - dist;
  }
  elem.style.left = xpos + "px";
  elem.style.top = ypos + "px";
  var repeat = "moveElement('"+elementID+"',"+final_x+","+final_y+","+interval+")";
  elem.movement = setTimeout(repeat,interval);
}

function classNormal(iFocusBtnID,iFocusTxID){
	var iFocusBtns= $(iFocusBtnID).getElementsByTagName('li');
	var iFocusTxs = $(iFocusTxID).getElementsByTagName('li');
	for(var i=0; i<iFocusBtns.length; i++) {
		iFocusBtns[i].className='normal';
		iFocusTxs[i].className='normal';
	}
}

function classCurrent(iFocusBtnID,iFocusTxID,n){
	var iFocusBtns= $(iFocusBtnID).getElementsByTagName('li');
	var iFocusTxs = $(iFocusTxID).getElementsByTagName('li');
	iFocusBtns[n].className='current';
	iFocusTxs[n].className='current';
}

function iFocusChange() {
	if(!$('ifocus')) return false;
	$('ifocus').onmouseover = function(){atuokey = true};
	$('ifocus').onmouseout = function(){atuokey = false};
	var iFocusBtns = $('ifocus_btn').getElementsByTagName('li');
	var listLength = iFocusBtns.length;
	iFocusBtns[0].onmouseover = function() {
		moveElement('ifocus_piclist',0,0,5);
		classNormal('ifocus_btn','ifocus_tx');
		classCurrent('ifocus_btn','ifocus_tx',0);
	}
	if (listLength>=2) {
		iFocusBtns[1].onmouseover = function() {
			moveElement('ifocus_piclist',0,-245,5);
			classNormal('ifocus_btn','ifocus_tx');
			classCurrent('ifocus_btn','ifocus_tx',1);
		}
	}
	if (listLength>=3) {
		iFocusBtns[2].onmouseover = function() {
			moveElement('ifocus_piclist',0,-490,5);
			classNormal('ifocus_btn','ifocus_tx');
			classCurrent('ifocus_btn','ifocus_tx',2);
		}
	}
	if (listLength>=4) {
		iFocusBtns[3].onmouseover = function() {
			moveElement('ifocus_piclist',0,-735,5);
			classNormal('ifocus_btn','ifocus_tx');
			classCurrent('ifocus_btn','ifocus_tx',3);
		}
	}
}

setInterval('autoiFocus()',5000);
var atuokey = false;
function autoiFocus() {
	if(!$('ifocus')) return false;
	if(atuokey) return false;
	var focusBtnList = $('ifocus_btn').getElementsByTagName('li');
	var listLength = focusBtnList.length;
	for(var i=0; i<listLength; i++) {
		if (focusBtnList[i].className == 'current') var currentNum = i;
	}
	if (currentNum==0&&listLength!=1 ){
		moveElement('ifocus_piclist',0,-245,5);
		classNormal('ifocus_btn','ifocus_tx');
		classCurrent('ifocus_btn','ifocus_tx',1);
	}
	if (currentNum==1&&listLength!=2 ){
		moveElement('ifocus_piclist',0,-490,5);
		classNormal('ifocus_btn','ifocus_tx');
		classCurrent('ifocus_btn','ifocus_tx',2);
	}
	if (currentNum==2&&listLength!=3 ){
		moveElement('ifocus_piclist',0,-735,5);
		classNormal('ifocus_btn','ifocus_tx');
		classCurrent('ifocus_btn','ifocus_tx',3);
	}
	if (currentNum==3 ){
		moveElement('ifocus_piclist',0,0,5);
		classNormal('ifocus_btn','ifocus_tx');
		classCurrent('ifocus_btn','ifocus_tx',0);
	}
	if (currentNum==1&&listLength==2 ){
		moveElement('ifocus_piclist',0,0,5);
		classNormal('ifocus_btn','ifocus_tx');
		classCurrent('ifocus_btn','ifocus_tx',0);
	}
	if (currentNum==2&&listLength==3 ){
		moveElement('ifocus_piclist',0,0,5);
		classNormal('ifocus_btn','ifocus_tx');
		classCurrent('ifocus_btn','ifocus_tx',0);
	}
}
addLoadEvent(iFocusChange);
</script>