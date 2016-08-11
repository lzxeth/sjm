<?php

/**
 * 1 战斗单元（士兵）
 */
abstract class Unit {
    //轰炸力度
    abstract function bombardStrength();
    abstract function addUnit( Unit $unit );
    abstract function removeUnit( Unit $unit );
}




/**
 * 2 军队
 */
class Army extends Unit{
    private $units = array();
    function addUnit( Unit $unit ) {
        if ( in_array( $unit, $this->units, true ) ) {
            return;
        }
        $this->units[] = $unit;
    }
    function removeUnit( Unit $unit ) {
        $this->units = array_udiff( $this->units, array( $unit ),function( $a, $b ) {
            return ($a === $b)?0:1;
        } );
    }

    function bombardStrength() {
        $ret = 0;
        foreach( $this->units as $unit ) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}


/**
 * 3 射手  //上边的军队可以添加士兵，但是射手不能再添加射手了，所以addUnit等方法就抛出异常
 */
class UnitException extends Exception {}

class Archer extends Unit {
    function addUnit( Unit $unit ) {
        throw new UnitException( get_class($this)." is a leaf" );
    }
    function removeUnit( Unit $unit ) {
        throw new UnitException( get_class($this)." is a leaf" );
    }
    function bombardStrength() {
        return 4;
    }
}

/**
 * 加农炮
 */
class LaserCannonUnit extends Unit {
    // 射手和加农炮级别的不能添加其他单元了，每个这个级别的类都要写exception吗？这儿怎么优化呢？
    function addUnit( Unit $unit ) {
        throw new UnitException( get_class($this)." is a leaf" );
    }
    function removeUnit( Unit $unit ) {
        throw new UnitException( get_class($this)." is a leaf" );
    }
    function bombardStrength() {
        return 44;
    }
}
