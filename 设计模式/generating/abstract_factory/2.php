<?php


abstract class CommsManager {
    const APPT = 1;
    const TTD = 2;
    const CONTACT = 3;
    abstract function getHeaderText();
    abstract function make( $flag_int ); //当然还可以通过一个make方法确定返回哪个Encoder
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager {
    function getHeaderText() {
        return "BloggsCal header\n";
    }
    function make( $flag_int ) {
        switch ( $flag_int ) {
            case self::APPT:
                return new BloggsApptEncoder();
            case self::CONTACT:
                return new BloggsContactEncoder();
            case self::TTD:
                return new BloggsTtdEncoder();
        }
    }
    function getFooterText() {
        return "BloggsCal footer\n";
    }
}
