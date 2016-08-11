<?php
/**
 * 需要多个工厂生成相关的类
 */


abstract class CommsManager {
    abstract function getHeaderText();
    abstract function getApptEncoder();
    abstract function getTtdEncoder();
    abstract function getContactEncoder();
    abstract function getFooterText();
}
class BloggsCommsManager extends CommsManager {
    function getHeaderText() {
        return "BloggsCal header\n";
    }
    function getApptEncoder() {
        return new BloggsApptEncoder();
    }
    function getTtdEncoder() {
        return new BloggsTtdEncoder();
    }
    function getContactEncoder() {
        return new BloggsContactEncoder();
    }
    function getFooterText() {
        return "BloggsCal footer\n";
    }
}
