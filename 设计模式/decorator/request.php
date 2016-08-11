<?php

// Decorator && Intercepting Filter.

class RequestHelper
{
}

//执行请求抽象类，装饰者和被装饰者都要有相同的方法，因为装饰者也可能被装饰，都要继承这个抽象类
abstract class ProcessRequest
{
    abstract function process(RequestHelper $req);
}

//处理请求的对象，会有其他装饰者装饰这个对象，这个对象就是被装饰者
class MainProcess extends ProcessRequest
{
    //被装饰，主体进程
    function process(RequestHelper $req)
    {
        print __CLASS__.": doing something useful with request\n";
    }
}

//装饰者抽象类，需要继承ProcessRequest，因为装饰者和被装饰者都要实现相同的方法
abstract class DecorateProcess extends ProcessRequest
{
    //装饰者对象
    protected $processrequest;

    //实例化时注册装饰者
    function __construct(ProcessRequest $pr)
    {
        $this->processrequest = $pr;
    }
}

//下边三个类都是装饰者
class LogRequest extends DecorateProcess
{
    function process(RequestHelper $req)
    {
        print __CLASS__.": logging request\n";
        $this->processrequest->process($req);
    }
}

class AuthenticateRequest extends DecorateProcess
{
    function process(RequestHelper $req)
    {
        print __CLASS__.": authenticating request\n";
        $this->processrequest->process($req);
    }
}

class StructureRequest extends DecorateProcess
{
    function process(RequestHelper $req)
    {
        print __CLASS__.": structuring request data\n";
        $this->processrequest->process($req);
    }
}


$process = new AuthenticateRequest(new StructureRequest(new LogRequest (new MainProcess())));
$process->process(new RequestHelper());

//output;
//AuthenticateRequest: authenticating request
//StructureRequest: structuring request data
//LogRequest: logging request
//MainProcess: doing something useful with request
