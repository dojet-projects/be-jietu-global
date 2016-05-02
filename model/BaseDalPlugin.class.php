<?php
/**
 * base dal plugin
 *
 * DAL code
 * Filename: BaseDalPlugin.class.php
 *
 * @author liyan
 * @since 2014 8 4
 */
abstract class BaseDalPlugin extends BasePlugin {

    protected $dbProxy;

    function __construct() {
        $this->dbProxy = BaseDal::getDBProxy(DBHUMOR);
    }

}

