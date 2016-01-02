<?php
// HTTP
define('HTTP_SERVER', 'http://www.demooc2.el-parduotuve.lt/');
// HTTPS
define('HTTPS_SERVER', 'http://www.demooc2.el-parduotuve.lt/');
// HTTPS
define('HTTPS_SERVER', 'http://www.demooc2.el-parduotuve.lt/');
//GLOBAL
define('WEBSITE_URL', 'http://www.demooc2.el-parduotuve.lt/');

// DIR
if (!defined('DS')) {
 define('DS', DIRECTORY_SEPARATOR); 
}
define('DIR_APPLICATION', $_SERVER['DOCUMENT_ROOT'].DS.'catalog'.DS);
define('DIR_SYSTEM', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS);
define('DIR_LANGUAGE', $_SERVER['DOCUMENT_ROOT'].DS.'catalog'.DS.'language'.DS);
define('DIR_TEMPLATE', $_SERVER['DOCUMENT_ROOT'].DS.'catalog'.DS.'view'.DS.'theme'.DS);
define('DIR_CONFIG', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'config'.DS);
define('DIR_IMAGE', $_SERVER['DOCUMENT_ROOT'].DS.'image'.DS);
define('DIR_CACHE', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'cache'.DS);
define('DIR_DOWNLOAD', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'storage'.DS.'download'.DS);
define('DIR_LOGS', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'storage'.DS.'logs'.DS);
define('DIR_MODIFICATION', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'modification'.DS);
define('DIR_UPLOAD', $_SERVER['DOCUMENT_ROOT'].DS.'system'.DS.'storage'.DS.'upload'.DS);

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'elparduo_demooc2');
define('DB_PASSWORD', 'EEee1111');
define('DB_DATABASE', 'elparduo_demooc2');
define('DB_PORT', '3306');
define('DB_PREFIX', '');
?>