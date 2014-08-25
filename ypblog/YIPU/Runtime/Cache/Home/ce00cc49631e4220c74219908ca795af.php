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
<style>

/**
 * Grid container
 */
#tiles {
list-style-type: none;
position: relative; /** Needed to ensure items are laid out relative to this container **/
margin: 0;
}

/**
 * Grid items
 */
#tiles li {
width: 240px;
background-color: #ffffff;
border: 1px solid #dedede;
-moz-border-radius: 2px;
-webkit-border-radius: 2px;
border-radius: 2px;
display: none; /** Hide items initially to avoid a flicker effect **/
  cursor: pointer;
padding: 4px;
}

#tiles li img {
display: block;
}

/**
 * Grid item text
 */
#tiles li p {
color: #666;
font-size: 11px;
line-height: 16px;
margin: 6px 0 1px 7px;
}

/** General page styling **/
  



/** Loader **/
  
#loader {
  height: 16px;
  text-align: center;
  padding: 25px 0 25px 0;
}
  
#loaderCircle {
  width: 16px;
  height: 16px;
margin: 0 auto;
  background-image: url('__PUBLIC__/Home/images/loader.gif');
}
.post .entry1 {
    padding: 0 10px 10px;
    text-align: justify;
}
</style>
<input id="mid" type="hidden" value="<?php echo (ACTION_NAME); ?>" />
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
	<div id="content">
	  <div class="post">
      <div class="entry1">
        <div id="container">
    <div id="main" role="main">

      <ul id="tiles">
        <!-- These is where we place content loaded from the Wookmark API -->
      </ul>

      <div id="loader">
        <div id="loaderCircle"></div>
      </div>
    
    </div>
      
  </div>
        </div>             
      </div>

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
  <!-- include jQuery -->
  <script src="__PUBLIC__/Js/pubu/jquery-1.7.1.min.js"></script>
  
  <!-- Include the plug-in -->
  <script src="__PUBLIC__/Js/pubu/jquery.wookmark.js"></script>
  
  <!-- Once the page is loaded, initalize the plug-in. -->
  <script type="text/javascript">
    var handler = null;
    var page = 0;
    var isLoading = false;
    var apiURL = 'getpic.html?mid='+$('#mid').val()
    
    // Prepare layout options.
    var options = {
      autoResize: true, // This will auto-update the layout when the browser window is resized.
      container: $('#tiles'), // Optional, used for some extra CSS styling
      offset: 8, // Optional, the distance between grid items
      itemWidth: 250 // Optional, the width of a grid item
    };
    
    /**
     * When scrolled all the way to the bottom, add more tiles.
     */
    function onScroll(event) {
      // Only check when we're not still waiting for data.
      if(!isLoading) {
        // Check if we're within 100 pixels of the bottom edge of the broser window.
        var closeToBottom = ($(window).scrollTop() + $(window).height() > $(document).height() - 100);
        if(closeToBottom) {
          loadData();
        }
      }
    };
    
    /**
     * Refreshes the layout.
     */
    function applyLayout() {
      // Clear our previous layout handler.
      if(handler) handler.wookmarkClear();
      
      // Create a new layout handler.
      handler = $('#tiles li');
      handler.wookmark(options);
    };
    
    /**
     * Loads data from the API.
     */
    function loadData() {
      isLoading = true;
      $('#loaderCircle').show();
      
      $.ajax({
        url: apiURL,
        dataType: 'json',
        data: {page: page}, // Page parameter to make sure we load new data
        success: onLoadData
      });
    };
    
    /**
     * Receives data from the API, creates HTML for images and updates the layout
     */
    function onLoadData(data) {
		//alert(data);
      isLoading = false;
      $('#loaderCircle').hide();
      
      // Increment page index for future calls.
      page++;
      
      // Create HTML for the images.
	  data=data.list;
      var html = '';
      var i=0, length=data.length, image;
     // alert(length);
      for(; i<length; i++) {
		 // alert(data[i].url_m);
        image = data[i].url_m;
		imageheight=data[i].imageheight;
		//alert();
		imagewidth=data[i].imagewidth;
        html += '<li>';
        
        // Image tag (preview in Wookmark are 200px wide, so we calculate the height based on that).
        html += '<img src="..'+image+'" width="240" height="'+Math.round(imageheight/imagewidth*240)+'">';
        
        // Image title.
        //html += '<p>'+image.title+'</p>';
        
        html += '</li>';
      }
      
      // Add image HTML to the page.
      $('#tiles').append(html);
      
      // Apply layout.
      applyLayout();
    };
  
    $(document).ready(new function() {
      // Capture scroll event.
      $(document).bind('scroll', onScroll);
      
      // Load first data from the API.
      loadData();
    });
  </script>
    
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