<?php
/**
 * 乱78糟的代码、接口，从log中提取id，查询Product数据
 */
function getProductFileLines( $file ) {
    return file( $file );
}
function getProductObjectFromId( $id, $productname ) {
    // 一些数据库查询
    return new Product( $id, $productname );
}

function getNameFromLine( $line ) {
    if ( preg_match( "/.*-(.*)\s\d+/", $line, $array ) ) {
        return str_replace( '_',' ', $array[1] );
    }
    return '';
}

function getIDFromLine( $line ) {
    if ( preg_match( "/^(\d{1,3})-/", $line, $array ) ) {
        return $array[1];
    }
    return -1;
}

class Product {
    public $id;
    public $name;
    function __construct( $id, $name ) {
        $this->id = $id;
        $this->name = $name;
    }
}

$lines = getProductFileLines( 'test.txt' );
$objects = array();
foreach ( $lines as $line ) {
    $id = getIDFromLine( $line );
    $name = getNameFromLine( $line );
    $objects[$id] = getProductObjectFromID( $id, $name );
}

/**
 * 加个外观吧
 */
class ProductFacade {
    private $products = array();
    function __construct( $file ) {
        $this->file = $file;
        $this->compile();
    }
    private function compile() {
        $lines = getProductFileLines( $this->file );
        foreach ( $lines as $line ) {
            $id = getIDFromLine( $line );
            $name = getNameFromLine( $line );
            $this->products[$id] = getProductObjectFromID( $id, $name );
        }
    }
    function getProducts() {
        return $this->products;
    }
    function getProduct( $id ) {
        if ( isset( $this->products[$id] ) ) {
            return $this->products[$id];
        }
        return null;
    }
}

//整洁了！
$facade = new ProductFacade( 'test.txt' );
$facade->getProduct( 234 );
