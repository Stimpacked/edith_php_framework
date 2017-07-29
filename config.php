<?php
/**
 * Config-file for Edith, the framework
 * These settings affect the installation
 */

// Set error reporting.
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly

// Define Edith paths.
define('EDITH_INSTALL_PATH', __DIR__);
define('EDITH_THEME_PATH',	 EDITH_INSTALL_PATH . '/public/theme/theme.tpl.php');
define('EDITH_STYLE_PATH',	 EDITH_INSTALL_PATH . '/public/css/');

// Define Theme-related settings
define('EDITH_TITLE',	' - Edith');		// Title
define('EDITH_LANG',	'en');				// Language

// Define Database-related settings
define('EDITH_DB_HOST',	'localhost');		// Servername
define('EDITH_DB_USER',		'root');		// Database username
define('EDITH_DB_PASS', 'root');			// Database password
define('EDITH_DB_NAME',		'mvc');			// Database name


//?XDEBUG_SESSION_START=sublime.xdebug
?>