<?php
include(__DIR__.'/2.php');

/**
 * 注册管理，场景是用户通过网站注册报名，网站程序要发通知给用户。
 */

/**
 * Class RegistrationMgr
 */
class RegistrationMgr {
    function register( Lesson $lesson ) {
        // 一些具体的注册逻辑、、略
        // 发送消息：
        $notifier = Notifier::getNotifier(); #!通过抽象工厂获取具体的 Notifier
        $notifier->inform( "您注册了新课程，费用为￥{$lesson->cost()}，请尽快缴费。。" );
    }
}

abstract class Notifier {
    static function getNotifier() {
        // 这儿可能是按程序配置或者用户资料设置中的选项，使用不同的方式发送：
        if ( rand(1,2) === 1 ) {
            return new MailNotifier();
        } else {
            return new TextNotifier();
        }
    }
    abstract function inform( $message );
}

class MailNotifier extends Notifier {
    function inform( $message ) {
        print "邮件通知：{$message}\n";
    }
}
class TextNotifier extends Notifier {
    function inform( $message ) {
        print "短信通知：{$message}\n";
    }
}


$lessons2 = new Lecture( 5, new FixedCostStrategy() );
$lessons1 = new Seminar( 3, new TimedCostStrategy() );

$mgr = new RegistrationMgr();
$mgr->register( $lessons1 );
$mgr->register( $lessons2 );

//短信通知：您注册了新课程，费用为￥15，请尽快缴费。。
//短信通知：您注册了新课程，费用为￥30，请尽快缴费。。
