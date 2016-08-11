<?php
/**
 * 设计一个类，按不同的课程类型执行不同的逻辑.
 * 这儿使用各种条件判断。。switch.
 */

/**
 * Class Lesson
 */
abstract class Lesson {
    private $duration;
    const FIXED = 1;
    const TIMED = 2;
    private $costtype;
    function __construct( $duration, $costtype=1 ) {
        $this->duration = $duration;
        $this->costtype = $costtype;
    }
    function cost() {
        switch ( $this->costtype ) {
            CASE self::TIMED :
                return (5 * $this->duration);
                break;
            CASE self::FIXED :
                return 30;
                break;
            default:
                $this->costtype = self::FIXED;
                return 30;
        }
    }

    function chargeType() {
        switch ( $this->costtype ) {
            CASE self::TIMED :
                return "计时收费";
                break;
            CASE self::FIXED :
                return "固定收费";
                break;
            default:
                $this->costtype = self::FIXED;
                return "固定收费";
        }
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

$lecture = new Lecture( 5, Lesson::FIXED );
echo "{$lecture->cost()} ({$lecture->chargeType()})\n";

$seminar= new Seminar( 3, Lesson::TIMED );
echo "{$seminar->cost()} ({$seminar->chargeType()})\n";


//30 (固定收费)
//15 (计时收费)
