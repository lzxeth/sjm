<?php
/**
 * 业务场景：一个个人预约管理系统，
 * 该系统需要和其他系统交换数据，
 * 需要使用不同的编码器，
 * 以后很可能增加新的编码器
 */

// Encoder 抽象类
abstract class ApptEncoder {
    abstract function encode();
}

// 各种具体的Encoder
class BloggsApptEncoder extends ApptEncoder {
    function encode() {
        return "BloggsCal 格式的预约数据\n";
    }
}
class MegaApptEncoder extends ApptEncoder {
    function encode() {
        return "MegaCal 格式的预约数据\n";
    }
}

// 负责管理、生成具体的Encoder
class CommsManager {
    const BLOGGS = 1;
    const MEGA = 2;
    private $mode = 1;
    function __construct( $mode ) {
        $this->mode = $mode;
    }

// 2. 每加一种逻辑都要判断吗？
    function getHeaderText() {
        switch ( $this->mode ) {
            case ( self::MEGA ):
                return "MegaCal header\n";
            default:
                return "BloggsCal header\n";
        }
    }

    function getApptEncoder() {
        switch ( $this->mode ) {
            case ( self::MEGA ):
                return new MegaApptEncoder();
            default:
                return new BloggsApptEncoder();
        }
    }
}

$comms = new CommsManager( CommsManager::MEGA );
$apptEncoder = $comms->getApptEncoder();
print $apptEncoder->encode();
