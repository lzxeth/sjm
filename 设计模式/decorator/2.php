<?php

/*装饰者模式*/
结构：装饰者和被装饰者都有共同的父类
*/
abstract class Tile {  //共同的父类
    abstract function getWealthFactor();
}

class Plains extends Tile {  //被装饰者
    private $wealthfactor = 2;

    function getWealthFactor() {
        return $this->wealthfactor;
    }
}

/**
 * 装饰者
 */
abstract class TileDecorator extends Tile {
    protected $tile;
    function __construct( Tile $tile ) {
        $this->tile = $tile;
    }
}

class DiamondDecorator extends TileDecorator {
    function getWealthFactor() {
        return $this->tile->getWealthFactor()+2;
    }
}
class PollutionDecorator extends TileDecorator {
    function getWealthFactor() {
        return $this->tile->getWealthFactor()-4;
    }
}


$tile = new Plains();
print $tile->getWealthFactor(); // 2

$tile = new DiamondDecorator( new Plains() );
print $tile->getWealthFactor(); // 4

$tile = new PollutionDecorator(new DiamondDecorator( new Plains() ));
print $tile->getWealthFactor(); // 0

