<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta property="qc:admins" content="755672634767330006375" />
<meta property="qc:admins" content="755672634767330006375" />
<meta name="keywords" content="怿朴的博客,PHP开发技术,PHP博客,WEB开发技术,OSCPHP" />
<meta name="description" content="<?php if($read["newcontent"] != null): echo (msubstr($read["newcontent"],0,130,'utf-8',true)); else: ?>怿朴的博客_OSCPHP www.oscphp.com 专注于PHP开发,Thinkphp框架的开发,把从工作中累积经验的经验分享给大家<?php endif; ?>" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>
<?php if(MODULE_NAME== 'Tag'): echo (ACTION_NAME); ?>_热门标签_OSCPHP_怿朴的博客<?php endif; ?>
<?php if((MODULE_NAME== 'Archive') and ($read["title"] != null) ): echo ($read["title"]); ?>_WEB开发_OSCPHP_怿朴的博客<?php endif; ?>
<?php if((MODULE_NAME== 'Archive') and ($read["title"] == null) ): echo (ACTION_NAME); ?>_WEB开发_OSCPHP_怿朴的博客<?php endif; ?>
<?php if(MODULE_NAME== 'Index'): ?>怿朴的博客_OSCPHP<?php endif; ?>
<?php if(MODULE_NAME== 'Message'): ?>留言_OSCPHP_怿朴的博客<?php endif; ?>
<?php if((MODULE_NAME== 'Photo')): echo (ACTION_NAME); ?>_WEB开发_OSCPHP_怿朴的博客<?php endif; ?>
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
<SCRIPT LANGUAGE="JavaScript">
var successimg='<img align="absmiddle" src="__PUBLIC__/Ypadmin/images/ok.gif">';
var errorimg='<img align="absmiddle" src="__PUBLIC__/Ypadmin/images/update.gif">';
 $(function(){
        $('#message').ajaxForm({
			target:        '#result',
            success:       complete,  // post-submit callback
            dataType: 'json'
        });
        function complete(data){
            if (data.status==1){
				$('#message').resetForm();
				$('#result').css("color","#066");
				$('#result').html(successimg+data.info);
				setTimeout("window.location = '<?php echo U('index');?>'",3000);
                // 更新列表
            }else{
                $('#result').css("color","#900");			
				$('#result').html(errorimg+data.info);
				//setTimeout("$('#result').hide(1000)",3000);
            }
        }

    });
function fleshVerify(type){ 
//重载验证码
var timenow = new Date().getTime();
$('#verifyImg')[0].src= "__URL__/verify/"+timenow;
}		
</script>
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
	  <div id="content">
        
		  <div class="post">
			
            <div style="width:100%;">
                <div class="feedback_description">
                <ul style="display:block">
                <?php if(is_array($lists)): foreach($lists as $key=>$lists): ?><li class="feedback_guest">
                        <p class="feedback_words"><?php if($lists["status"] == 2 ): echo ($lists["content"]); else: ?>留言审核中...<?php endif; ?></p>
                        <div class="feedback_buttons">
                        <p class="feedback_buttons_who"><?php if($lists["status"] == 2 ): echo ($lists["user"]); else: ?>某某人<?php endif; ?></p>
                        <p class="feedback_buttons_time"><?php echo (mdate($lists["creattime"])); ?></p>
                        <div style="clear:both"></div>
                        </div>
                    </li>
                    <?php if($lists["status"] == 2 && $lists["replay"] != null ): ?><li class="feedback_admin">
                        <p class="feedback_words"><?php echo ($lists["user"]); ?> 你好，<?php echo ($lists["replay"]); ?></p>
                        <div class="feedback_buttons">
                        <p class="feedback_buttons_who"> 怿朴 </p>
                        <p class="feedback_buttons_time"><?php echo (mdate($lists["replaytime"])); ?></p>
                        <div style="clear:both"></div>
                        </div>
                    </li><?php endif; endforeach; endif; ?>    
                </ul>
                </div>
          <div class="page_css" style="width:100%; height:48px; text-align:center;  line-height:48px;" >

			  <?php echo ($page); ?>
		  </div>
            <div id="result" class="type" style=" width:737px; margin-left:25px; height:25px; line-height:25px;"></div>
            
            <div class="review-form" style="display: block; width:737px; margin-left:25px;">
            <form id="message" method="post" action="<?php echo U('Message/message');?>">
            <div class="textarea">
            <textarea name="neirong"></textarea>
            </div>
            <div class="info">
            <input type="hidden" name="ajax" value="1">
            <input type="hidden" name="status" value="1">
            <input type="hidden" name="record" value="<?php echo ($read["id"]); ?>">
            <input type="hidden" name="module" value="Archive">
            <table border="0" cellpadding="0" cellspacing="0" height="78">
  <tr>
    <td>验证：</td>
    <td valign="top">&nbsp;<input name="verify" type="text" value="" style="width:78px;border:1px solid #CCC;padding:2px; HEIGHT:28PX; LINE-HEIGHT:28PX"  maxLength=5 size=10></td>
    <td  valign="top">&nbsp;&nbsp;<IMG id="verifyImg" SRC="<?php echo U('verify');?>" onclick="fleshVerify(1)" BORDER="0" ALT="点击刷新验证码" style="cursor:pointer" align="absmiddle" /></td>
  </tr>
  <tr>
    <td>昵称：</td>
    <td valign="bottom">&nbsp;<input type="text" name="user" value="" onfocus="$('#uname').val()==null" style="border:1px solid #CCC; padding:2px; line-height:24px; height:24px; width:78px;"></td>
    <td valign="bottom">&nbsp;&nbsp;<input class="submit" type="submit" name="submit" id="submit" value="发  布" /></td>
  </tr>
</table>            
            </div>
            <div style="clear:both"></div> 
            </form>
            </div> 
                    
            </div>          
            </div>
		</div>
        
 
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
</div>
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