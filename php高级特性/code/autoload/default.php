<?php

define('CLASS_DIR', 'class/')
/*
 * set_include_path 设置php包含文件的路径
 * get_include_path  获取当前php包含文件的路径，// 默认.:/usr/share/pear:/usr/share/php   //linux以:分割，win以;分割
 *PATH_SEPARATOR    常量，代表当前系统的分隔符
 */

set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);

// autoload ClassName.class.php 
spl_autoload_extensions('.class.php');   //注册并返回spl_autoload函数使用的默认文件扩展名。 

// Use default autoload implementation
spl_autoload_register();

