<?php

define('SGLOBAL', dirname(__FILE__).'/');
define('SCONFIG', SGLOBAL.'config/');
define('SMODEL', SGLOBAL.'model/');
define('SLIB', SGLOBAL.'lib/');
define('SDAL', SGLOBAL.'dal/');
define('SOBSERVER', SGLOBAL.'observer/');

defined('SAE_MYSQL_HOST_M') or define('SAE_MYSQL_HOST_M', '');
defined('SAE_MYSQL_HOST_S') or define('SAE_MYSQL_HOST_S', '');
defined('SAE_MYSQL_PORT') or define('SAE_MYSQL_PORT', '');
defined('SAE_MYSQL_USER') or define('SAE_MYSQL_USER', '');
defined('SAE_MYSQL_PASS') or define('SAE_MYSQL_PASS', '');
defined('SAE_MYSQL_DB') or define('SAE_MYSQL_DB', '');

DAutoloader::getInstance()->addAutoloadPathArray(
    array(
        SLIB,
        SMODEL,
        SDAL,
    )
);

Config::loadConfig(SCONFIG.'runtime');
Config::loadConfig(SCONFIG.'global');
Config::loadConfig(SCONFIG.'constants');
Config::loadConfig(SCONFIG.'database');
