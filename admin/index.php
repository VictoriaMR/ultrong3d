<?php
define('APP_MEMORY_START', memory_get_usage());
define('APP_TIME_START', microtime(true));
define('DS', '/');
define('ROOT_PATH', strtr(realpath(dirname(__FILE__).'/../').'/', '\\', '/'));
define('APP_TEMPLATE_TYPE', 'admin');
define('APP_STATIC', false);
define('APP_VIEW_MATCH', false);
define('APP_DOMAIN', 'https://3d.admin.cn/');
require ROOT_PATH.'frame/start.php';