<?php

namespace sjm;

define('APP_ROOT', __DIR__);

include(APP_ROOT.'/FileDb.php');
include(APP_ROOT.'/DbBehavior.php');


define('DB_FILE', '/tmp/test2.db');


$fileDb = FileDb::getInstance();

$fileDb->on('afterInsert', function($row) {
    echo "Inserted (From ".__FUNCTION__.")\n";
});



$fileDb->attachBehavior('DbBehavior', new DbBehavior());
$fileDb->insert(array('sijiaomao', 'cat@animals.org'));


echo "The First Line is: ".$fileDb->getFirstRecord();



