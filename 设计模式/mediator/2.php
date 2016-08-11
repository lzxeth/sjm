<?php


interface MediatorInterface {
    public function sendResponse($content);
    public function makeRequest();
    public function queryDb();
}

/**
 * 核心类
 */
class Mediator implements MediatorInterface {
    protected $server;
    protected $database;
    protected $client;
    public function setColleague(Database $db, Client $cl, Server $srv) {
        $this->database = $db;
        $this->server = $srv;
        $this->client = $cl;
    }
    public function makeRequest() {
        $this->server->process();
    }

    public function queryDb() {
        return $this->database->getData();
    }

    public function sendResponse($content) {
        $this->client->output($content);
    }
}

/**
 * Colleague is an abstract colleague who works together but he only knows
 * the Mediator, not other colleague.
 */
abstract class Colleague {
    /**
     * this ensures no change in subclasses
     * @var MediatorInterface
     */
    private $mediator;

    // for subclasses
    protected function getMediator() {
        return $this->mediator;
    }

    /**
     * @param MediatorInterface $medium
     */
    public function __construct(MediatorInterface $medium) {
        // in this way, we are sure the concrete colleague knows the mediator
        $this->mediator = $medium;
    }
}



/**
 * Client is a client that make request et get response
 */
class Client extends Colleague {
    public function request() {
        $this->getMediator()->makeRequest();
    }

    public function output($content) {
        echo $content;
    }
}

class Database extends Colleague {
    public function getData() {
        return "World";
    }
}

class Server extends Colleague {
    public function process() {
        $data = $this->getMediator()->queryDb();
        $this->getMediator()->sendResponse("Hello $data");
    }
}


$media = new Mediator();
$client = new Client($media);
$media->setColleague(new Database($media), $client, new Server($media));
// as you see, the 3 components Client, Server and Database are totally decoupled
$client->request();
//Hello World
