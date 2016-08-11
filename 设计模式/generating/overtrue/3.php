<?php
//--- 3. 搞一个厂子吧，“生产”员工的 -------------------------------------------------------


abstract class Employee {
    protected $name;
    private static $types = array( 'Minion', 'CluedUp', 'WellConnected' );
    static function create( $name ) {
        $num = rand( 1, count( self::$types ) )-1; #！统一管理
        $class = self::$types[$num];  //new class还可以这样new呢！！！！
        return new $class( $name );
    }
    function __construct( $name ) {
        $this->name = $name;
    }
    abstract function fire();
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
 * Class WellConnected 牛二代员工
 */
class WellConnected extends Employee {
    function fire() {
        print "{$this->name}：我爸是李刚！\n";
    }
}


/**
 * Class NastyBoss
 */
class NastyBoss {
    private $employees = array();

    function addEmployee( Employee $employee ) {
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
$boss->addEmployee( Employee::create( "李雷" ) );
$boss->addEmployee( Employee::create( "韩梅梅" ) );
$boss->addEmployee( Employee::create( "路西" ) );

$boss->projectFails();
$boss->projectFails();
$boss->projectFails();
//q

