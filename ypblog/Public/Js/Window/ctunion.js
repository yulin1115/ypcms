document.write('<div id="msg" style="filter:alpha(opacity=80);opacity:0.8;width:320px; z-index:111; height:0px;padding:8px;margin:2px; display:none; text-align:center; background:#f5f5f5; border:3px solid #CCCCCC; position:absolute;right:0;bottom:0;overflow:hidden"><div style="padding:5px"><span style="float:left"><b style="color:#000000;letter-spacing:5px;">系统提示信息</b></span><span style="float:right"><a href="javascript:;" onclick="hiddenMsg()">[ 关闭 ]</a></span></div><div id="msgContent" style="overflow:auto;margin:0 auto;text-align:center;line-height:88px;clear:both;"></div></div><bgsound id="sound" volume="100%">')
var msgTimer=new Object();
var resizeDivTimer=new Object();
var closeTimer=new Object();
var openMsgMaxH,closeTime;
var $=function(doc){return document.getElementById(doc)};
var msgObj=$("msg");
var msgContentObj=$("msgContent");
function showMsg(type){
	clearInterval(msgTimer);
	msgObj.style.display='';
    msgTimer=setInterval(function(){openMsg()},1);
	$("#msgContent").removeClass("dui cuo");
	$("#msgContent").addClass(type);
}
function openMsg(){
	msgH=parseInt(msgObj.style.height);
	if(msgH<openMsgMaxH){
		msgObj.style.height=(msgH+Math.ceil((openMsgMaxH-msgH)/8))+"px"
	}else{
		clearInterval(msgTimer);
		closeTimer=setTimeout(function(){hiddenMsg()},closeTime);
	}
}
function hiddenMsg(){
	clearInterval(msgTimer);
    msgTimer=setInterval(function(){closeMsg()},1);
}
function closeMsg(){
	msgH=parseInt(msgObj.style.height);
	if(msgH>0){
		msgObj.style.height=(msgH-Math.ceil(msgH/8))+"px"
	}else{
		msgObj.style.display='none';
		clearInterval(msgTimer);
		clearInterval(resizeDivTimer);
	}
}
function showMessage(msgContent,closeTimeNum,msgFrameWidth,msgFrameHeight,type){
	clearInterval(msgTimer);
	clearTimeout(closeTimer);
	$("sound").src = "tpl/Public/Ypadmin/images/bleep.mp3";
	msgContentObj.innerHTML=msgContent;
	if(closeTimeNum!=""){
		closeTime=closeTimeNum;
	}else{
		closeTime=5000;
	}
	if(msgFrameWidth!=""){
		msgObj.style.width=msgFrameWidth+"px";
	}else{
		msgObj.style.width="320px";
	}
	if(msgFrameHeight!=""){
		openMsgMaxH=parseInt(msgFrameHeight);
	}else{
		openMsgMaxH=100;
	}
	msgContentObj.style.width=(parseInt(msgObj.style.width)-16)+"px";
	msgContentObj.style.height=(openMsgMaxH-23)+"px";
	resizeDivTimer = setInterval(function(){resizeDiv()},1);
	showMsg(type);
}
msgObj.onmouseover=function(){clearTimeout(closeTimer)}
msgObj.onmouseout=function(){closeTimer=setTimeout(function(){hiddenMsg()},closeTime)}
function resizeDiv(){
	var doEle;
	doEle=document.body;
	if(document.documentElement.scrollTop) doEle=document.documentElement;
	msgObj.style.bottom = "-"+(doEle.scrollTop)+ "px";
	if(navigator.userAgent.indexOf("MSIE 6.0")!=-1) msgObj.style.bottom = "1px";
}
