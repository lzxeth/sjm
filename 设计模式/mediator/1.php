<?php

/**
 * 中介者模式
 *一般会有A调用C，C调用B，B调用A这种来回调用的情况，中介者就是把这些调用通过中介执行
 */
/**
 * 抽象中介者类
 */
abstract class Mediator
{
    static protected  $_colleaguesend = array(          //定义了调用的映射关系
        'ConcreteColleague1'=> 'ConcreteColleague2',
        'ConcreteColleague2'=> 'ConcreteColleague3',
        'ConcreteColleague3'=> 'ConcreteColleague1',
    );
    protected  $_colleagues = null; //array  
    public function register(Colleague $colleague) {
        $this->_colleagues[get_class($colleague)] = $colleague;
    }

    public abstract function operation($name, $message);
}
/**
 * 具体中介者类
 */
class ConcreteMediator extends Mediator
{

    public function operation($obj, $message) {
        $className = self::$_colleaguesend[get_class($obj)];
        if ($className == get_class($obj) ) {
            return ;
        }
        if ($this->_colleagues[$className]) {

            $this->_colleagues[$className]->notify($message);
        }
        return ;
    }
}
/**
 * 抽象同事类
 */
abstract class Colleague
{
    protected  $_mediator = null;

    public function __construct(Mediator $mediator) {

        $this->_mediator = $mediator;
        $mediator->register($this);
    }
    /**
     * 通过中介实现相互调用
     */
    public abstract function send($message);
    /**
     * 具体需要实现的业务逻辑代码
     */
    public abstract function notify($message);
}

/**
 * 具体同事类
 */
class ConcreteColleague1 extends Colleague
{
    public function __construct(Mediator $mediator) {
        parent::__construct($mediator);
    }

    public function send($message) {
        $this->_mediator->operation($this, $message);
    }

    public function notify($message) {
        echo "ConcreteColleague1 m:{$message}\n";
    }

}

/**
 * 具体同事类
 */
class ConcreteColleague2 extends Colleague
{
    public function __construct(Mediator $mediator) {
        parent::__construct($mediator);
    }

    public function send($message) {
        $this->_mediator->operation($this, $message);
    }
    public function notify($message) {
        echo "ConcreteColleague2 m:{$message}\n";
    }

}


/**
 * 具体同事类
 */
class ConcreteColleague3 extends Colleague
{
    public function __construct(Mediator $mediator) {
        parent::__construct($mediator);
    }

    public function send($message) {
        $this->_mediator->operation($this, $message);
    }
    public function notify($message) {
        echo "ConcreteColleague3 m:{$message}\n";
    }

}
$objMediator = new ConcreteMediator();
$objC1 = new ConcreteColleague1($objMediator);
$objC2 = new ConcreteColleague2($objMediator);
$objC3 = new ConcreteColleague3($objMediator);

$objC1->send("from ConcreteColleague1");
$objC2->send("from ConcreteColleague2");
$objC3->send("from ConcreteColleague3");  
