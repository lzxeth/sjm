<?php
interface LoggerInterface {
    public function log($str);
}

class NullLogger implements LoggerInterface {
    public function log($str) {
        // do nothing
    }
}

class PrintLogger implements LoggerInterface {
    public function log($str) {
        echo $str;
    }
}

/**
 * Service is dummy service that uses a logger
 */
class Service {
    protected $logger;

    public function __construct(LoggerInterface $log) {
        $this->logger = $log;
    }

    /**
     * do something ...
     */
    public function doSomething() {
        // no more check "if (!is_null($this->logger))..." with the NullObject pattern
        $this->logger->log('We are in ' . __METHOD__);
        // something to do...
    }
}

$service = new Service(new NullLogger());
$service->doSomething();
//NO OUTPUT
