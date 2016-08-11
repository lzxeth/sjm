<?php

/**
 * 1 战斗单元（士兵）
 */
abstract class Unit
{
    //轰炸力度
    abstract function bombardStrength();

    function addUnit(Unit $unit)
    {
        throw new UnitException(get_class($this)." is a leaf");
    }

    function removeUnit(Unit $unit)
    {
        throw new UnitException(get_class($this)." is a leaf");
    }
}


/**
 * 2 军队
 */
class Army extends Unit
{
    private $units = array();

    function addUnit(Unit $unit)
    {
        if (in_array($unit, $this->units, true)) {   //添加一个clone对象是不行的
            return;
        }
        $this->units[] = $unit;
    }

    function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($this->units, array($unit), function ($a, $b) {
            return ($a === $b) ? 0 : 1;
        });
    }

    function bombardStrength()
    {
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }

        return $ret;
    }
}


/**
 * 3 射手
 */
class UnitException extends Exception
{
}

class Archer extends Unit
{
    function bombardStrength()
    {
        return 4;
    }
}

/**
 * 加农炮
 */
class LaserCannonUnit extends Unit
{
    function bombardStrength()
    {
        return 44;
    }
}


// 创建一个军队
$main_army = new Army();
// 添加战斗单元
$main_army->addUnit(new Archer());
$main_army->addUnit(new LaserCannonUnit());

// 创建一个小军队
$sub_army = new Army();
// 添加战斗单元
$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());

// 把小军队加入大军队
$main_army->addUnit($sub_army);

// 计算总的攻击力
print "attacking with strength: {$main_army->bombardStrength()}\n";
