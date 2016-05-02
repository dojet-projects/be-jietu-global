<?php
$__c = &Config::configRefForKeyPath('global');

$__c['log_path'] = array(
    C_RUNTIME_MAC2010 => sys_get_temp_dir(),
);

$__c['orderstat'] = array(
    'wait' => array('name' => '待确认'),
    'confirm' => array('name' => '已确认'),
    'finish' => array('name' => '已完成'),
    'drop' => array('name' => '已取消'),
    );

unset($__c);