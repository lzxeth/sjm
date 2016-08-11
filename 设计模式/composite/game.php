<?php

//game2.php把不论是射手，加农炮还是军队都抽象为Unit

/**
 * 战斗单元（士兵）
 */
abstract class Unit {
    //攻击力度
    abstract function bombardStrength();
}

/**
 * 射手
 */
class Archer extends Unit {
    function bombardStrength() {
        return 4;
    }
}

/**
 * 加农炮
 */
class LaserCannonUnit extends Unit {
    function bombardStrength() {
        return 44;
    }
}


/**
 * 军队
 */
class Army {
    private $units = array();
    private $armies = array();

    function bombardStrength() {
        $ret = 0;
        //军队可以由战斗单元组成
        foreach( $this->units as $unit ) {
            $ret += $unit->bombardStrength();
        }
        //大军队还可以由其他小军队组成：
        foreach( $this->armies as $army ) {
            $ret += $army->bombardStrength();
        }
        return $ret;
    }


    function addUnit( Unit $unit ) {
        array_push( $this->units, $unit );
    }

    function addArmy( Army $army ) {
        array_push( $this->armies, $army );
    }
}

// 下一步，抽象一下，提取共有方法


