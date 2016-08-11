<?php

/**
 * 区域
 */
abstract class Tile {
    abstract function getWealthFactor();
}

/**
 * 平原
 */
class Plains extends Tile {
    private $wealthfactor = 2;
    //财富工厂
    function getWealthFactor() {
        return $this->wealthfactor;
    }
}

/**
 * 有钻石平原
 */
class DiamondPlains extends Plains {
    function getWealthFactor() {
        return parent::getWealthFactor() + 2;
    }
}

/**
 * 被污染的平原
 */
class PollutedPlains extends Plains {
    function getWealthFactor() {
        return parent::getWealthFactor() - 4;
    }
}

/**
 * 被污染的又有钻石的平原怎么办呢？
 */
//。。。
