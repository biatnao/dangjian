<?php

return array(

'DB_TYPE'               =>  'mysql',		// 数据库类型
'DB_HOST'               =>  '127.0.0.1',	// 服务器地址
'DB_NAME'               =>  'dangjian',		// 数据库名
'DB_USER'               =>  'root',			// 用户名
'DB_PWD'                =>  'root',				// 密码
'DB_PORT'               =>  '3306',			// 端口
'DB_PREFIX'             =>  'dj_',		// 数据库表前缀
'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
'DB_SLAVE_NO'           =>  '', // 指定从服务器序号
'DB_SQL_BUILD_CACHE'    =>  false, // 数据库查询的SQL创建缓存 3.2.3版本废弃
'DB_SQL_BUILD_QUEUE'    =>  'file',   // SQL缓存队列的缓存方式 支持 file xcache和apc 3.2.3版本废弃
'DB_SQL_BUILD_LENGTH'   =>  20, // SQL缓存的队列长度 3.2.3版本废弃
'DB_SQL_LOG'            =>  false, // SQL执行日志记录 3.2.3版本废弃
'DB_BIND_PARAM'         =>  false, // 数据库写入数据自动参数绑定
'DB_DEBUG'              =>  false,  // 数据库调试模式 3.2.3新增 
'DB_LITE'               =>  false,  // 数据库Lite模式 3.2.3新增 


// 缓存设置

'DATA_CACHE_TIME'       =>  0,      // 数据缓存有效期 0表示永久缓存
'DATA_CACHE_COMPRESS'   =>  false,   // 数据缓存是否压缩缓存
'DATA_CACHE_CHECK'      =>  false,   // 数据缓存是否校验缓存
'DATA_CACHE_PREFIX'     =>  '',     // 缓存前缀
'DATA_CACHE_TYPE'       =>  'File',  // 数据缓存类型,支持:File|Db|Apc|Memcache|Shmop|Sqlite|Xcache|Apachenote|Eaccelerator
'DATA_CACHE_PATH'       =>  TEMP_PATH,// 缓存路径设置 (仅对File方式缓存有效)
'DATA_CACHE_SUBDIR'     =>  false,    // 使用子目录缓存 (自动根据缓存标识的哈希创建子目录)
'DATA_PATH_LEVEL'       =>  1,        // 子目录缓存级别
    );