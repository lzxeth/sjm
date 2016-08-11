<?php

/*
这个代码的功能类似于查数据，先到memcahce查，没有的话再去mysql查。
*/


class Request {    //发起请求的类，只是测试用，跟责任链模式无关
    public $forDebugOnly;
    public $action;
    public $key;
    public $response;
}

abstract class Handler {                    //处理数据抽象类
    private $successor = null; //后继者

    final public function append(Handler $handler) {
        if (is_null($this->successor)) {
            $this->successor = $handler; //添加下一个链
        } else {
            $this->successor->append($handler);  //有下一个链再为下一个链添加链
        }
    }

    final public function handle(Request $req) {   //处理请求的方法
        $req->forDebugOnly = get_called_class();  //判断具体是哪一个类调用，跟责任链模式无关。
        $processed = $this->processing($req);
        if (!$processed) {
            // the request has not been processed by this handler => see the next
            if (!is_null($this->successor)) {
                $processed = $this->successor->handle($req);
            }
        }

        return $processed;
    }


    abstract protected function processing(Request $req);
}


class FastStorage extends Handler {         //快速处理数据类
    protected $data = array();
    public function __construct($data = array()) {
        $this->data = $data;
    }

    protected function processing(Request $req) {
        if ('get' === $req->action) {   //Request传入的查询模式，例子中都是get
            if (array_key_exists($req->key, $this->data)) {
                // 处理器可响应，于是返回数据
                $req->response = $this->data[$req->key];
                return true;
            }
        }

        return false;
    }
}

class SlowStorage extends Handler {     //慢速处理数据类
    protected $data = array();
    public function __construct($data = array()) {
        $this->data = $data;
    }

    protected function processing(Request $req) {
        if ('get' === $req->action) {
            if (array_key_exists($req->key, $this->data)) {
                $req->response = $this->data[$req->key];
                return true;
            }
        }
        return false;
    }
}

$slow = new SlowStorage(array('20141018' => 'happy', '20141019' => 'lucky')); //先存储一些数据
//$slow->append(new MoreSlowStorate());

$storageChain = new FastStorage(array('20141018' => 'happy'));  //先存储一些数据，比慢存贮少一个数据，为了测试
$storageChain->append($slow);  //把慢存储添加为快存贮的一个链条

$request = new Request();  //发起请求
$request->action = 'get';
$request->key = '20141018';

$result = $storageChain->handle($request);    //这个在快存贮了直接找到了，返回true表示。
echo $request->response."\n"; //happy
echo $request->forDebugOnly."\n"; //FastStorage

$request->key = '20141019';    //在发起一个快存贮没有的数据请求，快存贮会找下一个链来处理
$result = $storageChain->handle($request);
echo $request->response."\n"; //lucky
echo $request->forDebugOnly."\n"; //SlowStorage


