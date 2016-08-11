<?php
//--- 2. 把对象实例化的工作委托出来------------------------------------------------------


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
 * Class CluedUp 有学问的员工
 */
class CluedUp extends Employee {
    function fire() {
        print "{$this->name}：我要叫我的律师\n";
    }
}

/**
 * Class NastyBoss
 */
class NastyBoss {
    private $employees = array();

    function addEmployee( Employee $employee ) {   //添加员工时针对接口，而不针对实现
        $this->employees[] = $employee; #!
    }

    /**
     * 项目每失败一次就开除一人
     */
    function projectFails() {
        if ( count( $this->employees ) > 0 ) {
            $emp = array_pop( $this->employees );
            $emp->fire();
        }
    }
}




$boss = new NastyBoss();
$boss->addEmployee( new Minion( "韩梅梅" ) );  //创建任意类型的员工
$boss->addEmployee( new CluedUp( "李雷" ) );
$boss->addEmployee( new Minion( "路西" ) );
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();

//路西：我马上清理桌子走人
//李雷：我要叫我的律师
//韩梅梅：我马上清理桌子走人

//q
