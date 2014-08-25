<?php
$siteconfig= require CONF_PATH.'~config.php';
//print_r($siteconfig);
$conf= array(
    
//    'APP_AUTOLOAD_PATH' =>'@ORG.Uitl',
   // 'VAR_FILTERS'       =>'stripslashes,strip_tags',
       'URL_CASE_INSENSITIVE' =>true,
    'APP_GROUP_MODE'=>1,//开启独立分组
    'TAG_NESTED_LEVEL' =>5,//嵌套循环最多5级
    'URL_MODEL'         =>2,//REWRITE模式： 设置URL_MODEL 为2
    'APP_GROUP_LIST'    => 'Home,Ypadmin',
    'DEFAULT_GROUP'     =>'Home',
    'DB_FIELDTYPE_CHECK'=>true,
    'TMPL_STRIP_SPACE'  => true,
    'DEFAULT_THEME'     =>'default',
	'DB_TYPE'           => 'mysql',
	'DB_HOST'           => 'localhost',
	'DB_NAME'           =>'s549367db0',
	'DB_USER'           =>'root',
	'DB_PWD'            =>'',
	'DB_PORT'           =>'3306',
	'DB_PREFIX'         =>'yulin_',
    'VAR_PAGE'          =>'p',


);
return array_merge($conf,$siteconfig);
?>