<?php
// +----------------------------------------------------------------------
// | 系统：YIPUCMS   分组公共函数库
// +----------------------------------------------------------------------
// | Copyright (c) 2012 YIPU All rights reserved.
// +----------------------------------------------------------------------
// | 本系统采用THINKPHP3.1框架开发
// +----------------------------------------------------------------------
// | 作者: YIPU <719655143@qq.com>
// +----------------------------------------------------------------------
// | 页面创建时间: 2012-12-27
// +----------------------------------------------------------------------


function cutstr_html($string,$sublen){
	$string = strip_tags($string);
    $string = preg_replace ('/\n/is', '',$string);
    $string = preg_replace ('/ |　/is', '',$string);
    $string = preg_replace ('/&nbsp;/is', '',$string);
    preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $t_string);
    if(count($t_string[0]) - 0 > $sublen)
	$string = join('', array_slice($t_string[0],0,$sublen))."…";   
    else $string = join('', array_slice($t_string[0],0,$sublen));
    return $string;
}
function ClearHtml($content){  
   $content = preg_replace("/<a[^>]*>/i", "", $content);  
   $content = preg_replace("/<\/a>/i", "", $content);   
   $content = preg_replace("/<div[^>]*>/i", "", $content);  
   $content = preg_replace("/<\/div>/i", "", $content);      
   $content = preg_replace("/<!--[^>]*-->/i", "", $content);//注释内容  
   $content = preg_replace("/style=.+?['|\"]/i",'',$content);//去除样式  
   $content = preg_replace("/class=.+?['|\"]/i",'',$content);//去除样式  
   $content = preg_replace("/id=.+?['|\"]/i",'',$content);//去除样式     
   $content = preg_replace("/lang=.+?['|\"]/i",'',$content);//去除样式      
   $content = preg_replace("/width=.+?['|\"]/i",'',$content);//去除样式   
   $content = preg_replace("/height=.+?['|\"]/i",'',$content);//去除样式   
   $content = preg_replace("/border=.+?['|\"]/i",'',$content);//去除样式   
   $content = preg_replace("/face=.+?['|\"]/i",'',$content);//去除样式   
   $content = preg_replace("/face=.+?['|\"]/",'',$content);//去除样式 只允许小写 正则匹配没有带 i 参数
   return $content;
}

/*@function:指定位置插入字符串  
     * @par：$str原字符串  
     * $i:位置  
     * $substr:需要插入的字符串  
     * 返回：新组合的字符串  
     * */  
function str_insert($str, $i, $substr){  
    for($j=0; $j<$i; $j++){  
	    $startstr .= $str[$j];  
    }  
    for ($j=$i; $j<strlen($str); $j++){  
	    $laststr .= $str[$j];  
    }  
    $str = ($startstr . $substr . $laststr);  
    return $str;  
} 