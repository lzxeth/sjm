<?php

abstract class AbstractClass {

    abstract protected function doSomethingA();

    abstract protected function doSomethingB();

    final public function templateMethod() {
        $this->doSomethingA();
        // Do something if needed.
        $this->doSomethingB();
    }
}

class ConcreteClass extends AbstractClass {

    protected function doSomethingA() {
        // Do something.
    }

    protected function doSomethingB() {
        // Do something.
    }
}

$instance = new ConcreteClass();
$instance->templateMethod();
