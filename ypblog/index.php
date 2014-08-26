<?php
    //define('RUNTIME_PATH','./Cms/temp/');
    //开启调试模式y1分支
    define('APP_DEBUG', true);
    //定义项目名称
    define('APP_NAME', 'YIPU');
    //定义项目路径
    define('APP_PATH', './YIPU/');
    //定义项目公用路径
    define('PUBLIC_PATH', './Public/');	
    //加载框架入文件
	define('HTML_PATH','html/');
	//定义静态缓存路径
	define('HTML_READ_TYPE',1);
    require './YIPU/ThinkPHP/ThinkPHP.php';
	//echo __ROOT__;
	//if(!ini_get('zlib.output_compression') && C('OUTPUT_ENCODE')) ob_start('ob_gzhandler');
    //App::run();
?>