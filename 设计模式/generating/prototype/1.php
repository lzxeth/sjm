<?php

/*原型模式
	原型模式就是通过clone生成新的类
	用于创建一个对象的耗费资源比较多的时候，或者大量相似类的时候
*/
class Sea {}
class EarthSea extends Sea {}
class MarsSea extends Sea {}

class Plains {}
class EarthPlains extends Plains {}
class MarsPlains extends Plains {}

class Forest {}
class EarthForest extends Forest {}
class MarsForest extends Forest {}

/**
 * 地形工厂
 * Class TerrainFactory
 */
class TerrainFactory {
    private $sea;
    private $forest;
    private $plains;
    function __construct( Sea $sea, Plains $plains, Forest $forest ) {
        $this->sea = $sea;
        $this->plains = $plains;
        $this->forest = $forest;
    }
    function getSea( ) {
        return clone $this->sea;
    }
    function getPlains( ) {
        return clone $this->plains;
    }
    function getForest( ) {
        return clone $this->forest;
    }
}

//地球上的
$factory = new TerrainFactory( new EarthSea(), new EarthPlains(), new EarthForest() );
print_r( $factory->getSea() );
print_r( $factory->getPlains() );
print_r( $factory->getForest() );

//地球海，火星平原，地球森林，不用再去单独写类了
$factory = new TerrainFactory( new EarthSea(), new MarsPlains(), new EarthForest() );
