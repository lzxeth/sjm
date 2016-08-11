<?php
/**
 * 设计一个类，按不同的课程类型执行不同的逻辑.
 * 这次，计费改用“策略”实现
 * 策略模式
 * 例如数据库的封装就是防止以后如果修改数据库后再改代码。
 */

/**
 * Class Lesson
 */
abstract class Lesson {
    private $duration;
    private $costStrategy; #!
    function __construct( $duration, CostStrategy $strategy ) {  //第二个参数表示必须是抽象类CostStrategy的子类
        $this->duration = $duration;
        $this->costStrategy = $strategy;
    }
    function cost() {
        return $this->costStrategy->cost( $this );
    }
    function chargeType() {
        return $this->costStrategy->chargeType( );
    }
    function getDuration() {
        return $this->duration;
    }
    // 更多方法...
}

/**
 * 讲座
 */
class Lecture extends Lesson {
    // Lecture 特定的实现 ...
}

/**
 * 研讨班
 */
class Seminar extends Lesson {
    // Seminar 特定的实现 ...
}

/**
 * Class CostStrategy
 */
abstract class CostStrategy {
    abstract function cost( Lesson $lesson );
    abstract function chargeType();
}

/**
 * 计时收费策略
 */
class TimedCostStrategy extends CostStrategy {
    function cost( Lesson $lesson ) {
        return ( $lesson->getDuration() * 5 );
    }
    function chargeType() {
        return "计时收费";
    }
}

/**
 * 固定收费策略
 */
class FixedCostStrategy extends CostStrategy {
    function cost( Lesson $lesson ) {
        return 30;
    }
    function chargeType() {
        return "固定收费";
    }
}

/*
 * test
 */
/*
$lessons[] = new Lecture( 5, new FixedCostStrategy() );
$lessons[] = new Seminar( 3, new TimedCostStrategy() );

foreach ( $lessons as $lesson ) {
    echo "{$lesson->cost()} ({$lesson->chargeType()})\n";
}


//30 (固定收费)
//15 (计时收费)
