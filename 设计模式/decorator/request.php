<?php
// Decorator && Intercepting Filter.

class RequestHelper{}

abstract class ProcessRequest {  //装饰者和被装饰者都有proecss方法，所以抽象出一个类
    abstract function process( RequestHelper $req );
}

class MainProcess extends ProcessRequest {  //被装饰，主体进程
    function process( RequestHelper $req ) {
        print __CLASS__.": doing something useful with request\n";
    }
}

abstract class DecorateProcess extends ProcessRequest {   //装饰者的抽象
    protected $processrequest;
    function __construct( ProcessRequest $pr ) {
        $this->processrequest = $pr;
    }
}

class LogRequest extends DecorateProcess {   //下边三个类都是装饰者
    function process( RequestHelper $req ) {
        print __CLASS__.": logging request\n";
        $this->processrequest->process( $req );
    }
}

class AuthenticateRequest extends DecorateProcess {
    function process( RequestHelper $req ) {
        print __CLASS__.": authenticating request\n";
        $this->processrequest->process( $req );
    }
}

class StructureRequest extends DecorateProcess {
    function process( RequestHelper $req ) {
        print __CLASS__.": structuring request data\n";
        $this->processrequest->process( $req );
    }
}


$process = new AuthenticateRequest( new StructureRequest(   new LogRequest (  new MainProcess() ) ) );
$process->process( new RequestHelper() );

//output;
//AuthenticateRequest: authenticating request
//StructureRequest: structuring request data
//LogRequest: logging request
//MainProcess: doing something useful with request
