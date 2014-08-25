<?php

// +----------------------------------------------------------------------
// | ThinkPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2008 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

// 自动转换字符集 支持数组转换
function auto_charset($fContents, $from='gbk', $to='utf-8') {
    $from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
    $to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
    if (strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
        //如果编码相同或者非字符串标量则不转换
        return $fContents;
    }
    if (is_string($fContents)) {
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($fContents, $to, $from);
        } elseif (function_exists('iconv')) {
            return iconv($from, $to, $fContents);
        } else {
            return $fContents;
        }
    } elseif (is_array($fContents)) {
        foreach ($fContents as $key => $val) {
            $_key = auto_charset($key, $from, $to);
            $fContents[$_key] = auto_charset($val, $from, $to);
            if ($key != $_key)
                unset($fContents[$key]);
        }
        return $fContents;
    }
    else {
        return $fContents;
    }
}




/* 数组搜索 */

function search($list, $condition) {
    if (is_string($condition))
        parse_str($condition, $condition);
    $resultSet = array();
    foreach ($list as $key => $data) {
        $find = false;
        foreach ($condition as $field => $value) {
            if (isset($data[$field])) {
                if (0 === strpos($value, '/')) {
                    $find = preg_match($value, $data[$field]);
                } elseif ($data[$field] == $value) {
                    $find = true;
                }
            }
        }
        if ($find)
            $resultSet[] = &$list[$key];
    }
    return $resultSet;
}



/* 密码处理 */

function pwdHash($password, $type = 'md5') {
    return hash($type, $password);
}
/*编辑器*/
function editor($id,$name,$width,$height,$content){
	$kindeditor="<script charset=\"utf-8\" src=\"".__ROOT__."/Public/Plug/kindeditor/kindeditor.js\"></script>
                 <script charset=\"utf-8\" src=\"".__ROOT__."/Public/Plug/kindeditor/lang/zh_CN.js\"></script>
		         <script>
			     KindEditor.ready(function(K) {
				    window.editor = K.create('#".$id."', {
					     themeType : 'default',
						 cssPath : \"".__ROOT__."/Public/Css/kindeditor/pre.css\",
						 afterCreate : function() {
                           this.sync();
                         },
                         afterBlur : function(){
                             this.sync();
                         } 
				     });
	             });
		         </script>
				 <textarea id=\"".$id."\" name=\"".$name."\" style=\"width:".$width."px;height:".$height."px;visibility:hidden;\">".$content."</textarea>";
	return $kindeditor;
}
/* 生成不重复数 */

function build_count_rand($number, $length = 4, $mode = 1) {
    if ($mode == 1 && $length < strlen($number)) {
        return false;
    }
    $rand = array();
    for ($i = 0; $i < $number; $i++) {
        $rand[] = rand_string($length, $mode);
    }
    $unqiue = array_unique($rand);
    if (count($unqiue) == count($rand)) {
        return $rand;
    }
    $count = count($rand) - count($unqiue);
    for ($i = 0; $i < $count * 3; $i++) {
        $rand[] = rand_string($length, $mode);
    }
    $rand = array_slice(array_unique($rand), 0, $number);
    return $rand;
}

/* 时间格式化 */

function toDate($time, $format = 'Y-m-d H:i:s') {
    if (empty($time)) {
        return '';
    }
    $format = str_replace('#', ':', $format);
    return date(($format), $time);
}





	/**
     * 删除CONTENT中的图片 2011.4.11
     * Author:YIPU (719655143@qq.com)
     * Copyright (c) 版权所有
     */
function delContentPic($content){
	$ext = 'gif|jpg|jpeg|bmp|png';
	$p="/(src)=([\"|']?)([^ \"'>]+\.($ext))\\2/i";
    if(preg_match_all($p , $content, $matches)){
		foreach($matches[3] as $k => $v){
	        $str = str_replace(__ROOT__,'.', $v);
	    //echo $new_url;
			unlink($str);
		}
	}
}
	
function genTree($items,$id='id',$pid='pid',$son = 'children'){
	$tree = array(); //格式化的树
	$tmpMap = array();  //临时扁平数据	
	foreach ($items as $item) {
		$tmpMap[$item[$id]] = $item;
	}
	foreach ($items as $item) {
		if (isset($tmpMap[$item[$pid]])) {
			$tmpMap[$item[$pid]][$son][] = &$tmpMap[$item[$id]];
		} else {
			$tree[] = &$tmpMap[$item[$id]];
		}
	}
	return $tree;
}	

	/**
	 * 时间格式化
	 * @param	string		$sourcedate		原始时间戳或者时间字符串
	 * @param	string		$dateformat		时间格式字符串
	 * @param	string		$timestamp		当前时间戳或者指定的时间戳
	 * @param	int			$format			是否转换
	 * @return  string
	 */
function mdate($sourcedate,$dateformat='Y-m-d H:i:s', $timestamp='', $format=1) {
		if(is_numeric($sourcedate)) $sourcstamp = $sourcedate;
		else $sourcstamp = strtotime($sourcedate);
		$sourcedate = date($dateformat,$sourcstamp);

		if(empty($timestamp)) {
			$timestamp = time();
		}else if(!is_numeric($timestamp)) $timestamp = strtotime($timestamp);
		$result = '';
		if($format) {
			$time = $timestamp - $sourcstamp;
			if($time > 24*3600) {
				$date = floor($time / (24*3600));
				if($date > 30) $result = 	$sourcedate;
				else $result = $date.'天以前';
			} elseif ($time > 3600) {
				$result = intval($time/3600).'小时以前';
			} elseif ($time > 60) {
				$result = intval($time/60).'分钟以前';
			} elseif ($time > 0) {
				$result = $time.'秒以前';
			} else {
				$result = '现在';
			}
		} else {
			$result = $sourcedate;
		}
		//echo "$sourcedate,$sourcstamp,$timestamp,$time,$result<br>";
		return $result;
	}	
	
	/**
	 * 将内容过滤成文本
	 * @param	string $document		待处理字符串
	 * @return  string
	 */
function stripText($document){

		// I didn't use preg eval (//e) since that is only available in PHP 4.0.
		// so, list your entities one by one here. I included some of the
		// more common ones.

		$search = array("'<script[^>]*?>.*?</script>'si",	// strip out javascript
						"'<[\/\!]*?[^<>]*?>'si",			// strip out html tags
						"'([\r\n])[\s]+'",					// strip out white space
						"'&(quot|#34|#034|#x22);'i",		// replace html entities
						"'&(amp|#38|#038|#x26);'i",			// added hexadecimal values
						"'&(lt|#60|#060|#x3c);'i",
						"'&(gt|#62|#062|#x3e);'i",
						"'&(nbsp|#160|#xa0);'i",
						"'&(iexcl|#161);'i",
						"'&(cent|#162);'i",
						"'&(pound|#163);'i",
						"'&(copy|#169);'i",
						"'&(reg|#174);'i",
						"'&(deg|#176);'i",
						"'&(#39|#039|#x27);'",
						"'&(euro|#8364);'i",				// europe
						"'&a(uml|UML);'",					// german
						"'&o(uml|UML);'",
						"'&u(uml|UML);'",
						"'&A(uml|UML);'",
						"'&O(uml|UML);'",
						"'&U(uml|UML);'",
						"'&szlig;'i",
						"'　'" //全角空格
						);
		$replace = array(	"",
							"",
							"\\1",
							"\"",
							"&",
							"<",
							">",
							" ",
							chr(161),
							chr(162),
							chr(163),
							chr(169),
							chr(174),
							chr(176),
							chr(39),
							chr(128),
							"ä",
							"ö",
							"ü",
							"Ä",
							"Ö",
							"Ü",
							"ß",
							""
						);

		$text = preg_replace($search,$replace,$document);

		return $text;
	}	
//截取字符串
function msubstr($str, $start=0, $length, $charset="utf-8",$suffix=true)
{
if(strlen($str)/3>$length){
if(function_exists("mb_substr")){
return mb_substr($str, $start, $length, $charset).'…';
}
elseif(function_exists('iconv_substr')) {
return iconv_substr($str,$start,$length,$charset).'…';
}
$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
preg_match_all($re[$charset], $str, $match);
$slice = join("",array_slice($match[0], $start, $length));
if($suffix){
return $slice;
}else{
return $slice;
}
}
return $str;
}
?>