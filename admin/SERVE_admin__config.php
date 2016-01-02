<?php
/// HTTP
define('HTTP_SERVER', 'http://www.demooc2.el-parduotuve.lt/admin/');
define('HTTP_CATALOG', 'http://www.demooc2.el-parduotuve.lt/');
define('HTTP_IMAGE', 'http://www.demooc2.el-parduotuve.lt/image/');

// HTTPS
define('HTTPS_SERVER', 'http://www.demooc2.el-parduotuve.lt/admin/');
define('HTTPS_CATALOG', 'http://www.demooc2.el-parduotuve.lt/');
define('HTTPS_IMAGE', 'http://www.demooc2.el-parduotuve.lt/image/');

//GLOBAL
define('WEBSITE_URL', 'http://www.demooc2.el-parduotuve.lt/');

// DIR
if (!defined('DS')) {
 define('DS', DIRECTORY_SEPARATOR); 
}
define('DIR_APPLICATION', $_SERVER['DOCUMENT_ROOT'].DS.'admin'.DS);
define('DIR_SYSTEM', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS);
define('DIR_LANGUAGE', $_SERVER['DOCUMENT_ROOT'].DS.'admin'.DS.'language'.DS);
define('DIR_TEMPLATE', $_SERVER['DOCUMENT_ROOT'].DS.'admin'.DS.'view'.DS.'template'.DS);
define('DIR_CONFIG', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'config'.DS);
define('DIR_IMAGE', $_SERVER['DOCUMENT_ROOT'].DS.'image'.DS);
define('DIR_CACHE', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'cache'.DS);
define('DIR_DOWNLOADS', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'download'.DS);
define('DIR_UPLAD', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'upload'.DS);
define('DIR_LOGS', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'logs'.DS);
define('DIR_MODIFICATION', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'modification'.DS);
define('DIR_CATALOG', $_SERVER['DOCUMENT_ROOT'].DS.'catalog'.DS);


// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'elparduo_demooc2');
define('DB_PASSWORD', 'EEee1111');
define('DB_DATABASE', 'elparduo_demooc2');
define('DB_PREFIX', '');
?>