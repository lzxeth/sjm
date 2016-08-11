<?php


interface StrategyInterface
{
    /**
     * Do something.
     *
     * @return void
     */
    public function doSomething();
}

class StrategyA implements StrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function doSomething()
    {
        // Do something.
    }
}

class StrategyB implements StrategyInterface
{
    /**
     * {@inheritDoc}
     */
    public function doSomething()
    {
        // Do something.
    }
}

class Context
{
    /**
     * @var null|StrategyInterface
     */
    private $strategy = null;
    /**
     * @param StrategyInterface $strategy
     */
    public function __construct(StrategyInterface $strategy) //传递的是接口，不是具体的类，即依赖抽象原则
    {
        $this->strategy = $strategy;
    }
    /**
     * Do something with the Strategy.
     */
    public function doSomething()
    {
        $this->strategy->doSomething();
    }
}


$contextA = new Context(new StrategyA());
$contextA->doSomething();
$contextB = new Context(new StrategyB());
$contextB->doSomething();
