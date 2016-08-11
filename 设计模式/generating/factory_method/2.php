<?php

//--- 2 -----------------------------------------------

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

// 也抽象了
abstract class CommsManager {
    abstract function getHeaderText();
    abstract function getApptEncoder();
    abstract function getFooterText();
}


class BloggsCommsManager extends CommsManager {
    function getHeaderText() {
        return "BloggsCal header\n";
    }
    function getApptEncoder() {
        return new BloggsApptEncoder();
    }
    function getFooterText() {
        return "BloggsCal footer\n";
    }
}


$mgr = new BloggsCommsManager();
print $mgr->getHeaderText();
print $mgr->getApptEncoder()->encode();
print $mgr->getFooterText();
