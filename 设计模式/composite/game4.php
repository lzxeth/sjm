<?php

abstract class Unit
{
    function getComposite()
    {
        //获得组合体，看是否能添加子节点，例如加农炮不能添加加农炮
        return null;
    }

    abstract function bombardStrength();
}


abstract class CompositeUnit extends Unit
{
//可以组合的Unit
    private $units = array();

    function getComposite()
    {
        //可以组合的这里返回$this
        return $this;
    }

    protected function units()
    {
        return $this->units;
    }

    function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($this->units, array($unit),
            function ($a, $b) {
                return ($a === $b) ? 0 : 1;
            });
    }

    function addUnit(Unit $unit)
    {
        if (in_array($unit, $this->units, true)) {
            return;
        }
        $this->units[] = $unit;
    }
}

//对Unit的使用
class UnitScript
{
    static function joinExisting(Unit $newUnit, Unit $occupyingUnit)
    {
        if (!is_null($comp = $occupyingUnit->getComposite())) { //如果能组合，例如军队，就直接添加
            $comp->addUnit($newUnit);
        } else {  //对不能直接添加的单元，要先new一个army作为能添加的单元，然后把两个单元加入这个army
            $comp = new Army();
            $comp->addUnit($occupyingUnit);
            $comp->addUnit($newUnit);
        }

        return $comp;
    }
}

/**
 * 运兵车，不能装骑兵的马
 */
class TroopCarrier extends CompositeUnit
{
    function addUnit(Unit $unit)
    {
        if ($unit instanceof Cavalry) {
            throw new UnitException("Can't get a horse on the vehicle");
        }
        super::addUnit($unit);
    }

    function bombardStrength()
    {
        return 0;
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
