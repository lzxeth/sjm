<?php
//-- 1. 奸诈老板和那年的员工 --------------------------------------------------------

//
abstract class Employee {
    protected $name;
    function __construct( $name ) {
        $this->name = $name;
    }
    abstract function fire(); #！
}

/**
 * Class Minion 弱势员工
 */
class Minion extends Employee {
    function fire() {
        print "{$this->name}：我马上清理桌子走人\n";
    }
}

/**
 * Class NastyBoss
 */
class NastyBoss {
    private $employees = array();

    function addEmployee( $employeeName ) {
        $this->employees[] = new Minion( $employeeName ); #!
    }

    /**
