<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站管理系统，后台登陆</title>
<link href="__PUBLIC__/Ypadmin/css/style.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/Js/Window/ctunion.js"></script> 
<script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/Js/Jquery/jquery.form.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Window/alertdiv.js"></script>
<style type="text/css">
body{padding:0;margin:0px;font-size:12px;color:#555;font-family:Verdana;}
select{margin-left:1.5em;vertical-align:middle;border:1px solid #b4cceb;height:22px;font-size:12px;}
#main{width:800px;margin:auto;}
*{padding:0;margin:0}
input{font-size:12px;}

.logo{padding:100px 0 0 200px;}
.login{margin:0 0 0 140px;padding-top:80px;}
.login th{height:33px;line-height:33px;list-style:none;text-align:right;font-weight:normal;width:200px;font-size:12px;}
.login td{text-align:left;font-size:12px;}

.logo-icon{border: 1px solid; border-color: #8cb7e1 #e3f0fc #e3f0fc #8cb7e1;float:left;background:#fff;}

.bottom{text-align:center;margin:auto;padding-top:1em;color:#888;}
a{color:#888; text-decoration:none;}
</style>

<SCRIPT LANGUAGE="JavaScript">
 $(function(){
        $('#form1').ajaxForm({
            beforeSubmit:  checkForm,  // pre-submit callback
            success:       complete,  // post-submit callback
            dataType: 'json'
        });
        function checkForm(){

        }
        function complete(data){
            if (data.status==1){
                showMessage(data.info,4000,211,111,'dui');
				setTimeout("window.location = '<?php echo U('Ypadmin/Index/index');?>'",3000);
                // 更新列表
            }else{
                showMessage(data.info,4000,211,111,'cuo');
            }
        }

    });

function fleshVerify(type){ 
//重载验证码
var timenow = new Date().getTime();
$('#verifyImg')[0].src= "__URL__/verify/"+timenow;
}
</script>
</head>
<body>
<div id="main">
    <div id="wrap">
     <div class="logo">
          <span style="font-family: '微软雅黑'; font-size:24px; font-weight:bold; color:black;">JTADMIN</span>&nbsp;&nbsp;by <a href="http://www.oscphp.com" target="_blank">怿朴的博客</a>&nbsp;&nbsp;2013.01
     </div>
    </div>
    <div id="wrapb"></div>
    <div id="wrapc">
     <div class="login">
          <form method="post" name="login" id="form1" action="<?php echo U('Ypadmin/Public/checkLogin');?>">
          <input type="hidden" name="ajax" value="1">
           <table cellpadding="0" cellspacing="0" width="100%">
            <tr><th>管理员账号:</th><td><div class="logo-icon">
            <input style="border:1px solid #CCC; HEIGHT:25PX; width:128px; LINE-HEIGHT:25PX" name="username" type="text" /></div></td></tr>
            <tr><th>密码:</th><td><div class="logo-icon">
            <input style="border:1px solid #CCC; HEIGHT:25PX; width:128px; LINE-HEIGHT:25PX" type="password" name="password" /></div></td></tr>
            <tr><th>认证码:</th><td><div class="logo-icon">
            <input name="verify" type="text" value="" style="width:68px;border:1px solid #CCC; HEIGHT:25PX; LINE-HEIGHT:25PX"  maxLength=5 size=10></div>&nbsp;<IMG id="verifyImg" SRC="<?php echo U('Ypadmin/Public/verify');?>" onclick="fleshVerify(1)" BORDER="0" ALT="点击刷新验证码" style="cursor:pointer" align="absmiddle" /></td></tr>
            <tr><th></th><td><input id="denglu-submit" style=" border:0px; height:30px;width:80px;cursor:pointer;" type="submit"  value=""></td></tr>
           </table>
          </form>
     </div>
    </div>
</div>
<div class="bottom">Powered by © 2012－2013 Powered by 怿朴 (www.oscphp.com) <a href="http://www.oscphp.com" target="_blank"></a></div>
</form>
</body></html>