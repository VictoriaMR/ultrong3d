<?php
define('APP_MEMORY_START', memory_get_usage());
define('APP_TIME_START', microtime(true));
define('DS', '/');
define('ROOT_PATH', strtr(realpath(dirname(__FILE__).'/../').'/', '\\', '/'));
define('APP_TEMPLATE_TYPE', 'home');
define('APP_STATIC', false);
define('APP_VIEW_MATCH', true);
define('APP_DOMAIN', 'https://3d.cn/');
require ROOT_PATH.'frame/start.php';