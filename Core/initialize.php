<?php

// to set up the api

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'APIassignment');
defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

require_once(INC_PATH.DS.'config.php');
require_once(CORE_PATH.DS.'user.php');
require_once(CORE_PATH.DS.'table.php');
require_once(CORE_PATH.DS.'menu.php');
require_once(CORE_PATH.DS.'menuItem.php');
require_once(CORE_PATH.DS.'ingredients.php');
require_once(CORE_PATH.DS.'orders.php');
