<?php

/**
 * 一个更实际的例子
 */
class ShopProduct {
    public static function getInstance( $id, PDO $dbh ) {
        $query = "select * from products where id = ?";
        $stmt = $dbh->prepare( $query );
        if ( ! $stmt->execute( array( $id ) ) ) {
            $error=$dbh->errorInfo();
            die( "failed: ".$error[1] );
        }
        $row = $stmt->fetch( );
        if ( empty( $row ) ) { return null; }
        if ( $row['type'] == "book" ) {
            // 初始化 BookProduct
            $product = new BookProduct();       //BookProduct , CdProduct有一个公共的抽象父类,代码没体现
        } else if ( $row['type'] == "cd" ) {
            $product = new CdProduct();
            // 初始化 CdProduct
        } else {
            // 初始化一个 ShopProduct 。。。
        }
        $product->setId( $row['id'] );
        $product->setDiscount( $row['discount'] );
        return $product;
    }
}
