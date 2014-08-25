<?php
return array(
   // 'URL_ROUTER_ON'      =>true, //开启路由
    //'URL_MODEL'          =>2,
    'AUTO_BUILD_HTML'    =>0,
	'USER_AUTH_ON'       =>true,
	'USER_AUTH_TYPE'	 =>1,                       // 默认认证类型 1 登录认证 2 实时认证
    'RBAC_ROLE_TABLE'    =>'yulin_role',
    'RBAC_USER_TABLE'    =>'yulin_role_user',
    'RBAC_ACCESS_TABLE'  =>'yulin_access',
    'RBAC_NODE_TABLE'    =>'yulin_node',
	'USER_AUTH_KEY'		 =>'yulin_uid',                // 用户认证SESSION标记
    'ADMIN_AUTH_KEY'	 =>'administrator',
	'USER_AUTH_MODEL'	 =>'User',                  // 默认验证数据表模型
	'AUTH_PWD_ENCODER'	 =>'md5',                   // 用户认证密码加密方式
	'USER_AUTH_GATEWAY'	 =>'/Ypadmin/Public',	// 默认认证网关
	'NOT_AUTH_MODULE'	 =>'Public',                // 默认无需认证模块
	'REQUIRE_AUTH_MODULE'=>'',                      // 默认需要认证模块
	'NOT_AUTH_ACTION'	 =>'',                      // 默认无需认证操作
	'REQUIRE_AUTH_ACTION'=>'',                      // 默认需要认证操作
    'GUEST_AUTH_ON'      =>false,                  // 是否开启游客授权访问
    'GUEST_AUTH_ID'      =>0,                       // 游客的用户ID
	'SHOW_RUN_TIME'      =>false,                    // 运行时间显示
	'SHOW_ADV_TIME'      =>false,                    // 显示详细的运行时间
	'SHOW_DB_TIMES'      =>false,                    // 显示数据库查询和写入次数
	'SHOW_CACHE_TIMES'   =>false,                    // 显示缓存操作次数
	'SHOW_USE_MEM'       =>false,                    // 显示内存开销
    'SHOW_PAGE_TRACE'    =>1,
    'LIKE_MATCH_FIELDS'  =>'title|remark',
    'TAG_NESTED_LEVEL'   =>3,
	'TMPL_PARSE_STRING'  => array(   
     '__GROUPNAME__' =>'Ypadmin',//项目当前分组名称
	 ) ,
    'UPLOAD_FILE_RULE'	 =>'uniqid',                //  文件上传命名规则 例如 time uniqid com_create_guid 等 支持自定义函数 仅适用于内置的UploadFile类

);
?>