<?php
/**
 * Visitor design pattern (example of implementation)
 *
 * @author Enrico Zimuel (enrico@zimuel.it)
 * @see    http://en.wikipedia.org/wiki/Visitor_pattern
 */

interface Visited {  //被访问者
    public function accept(Visitor $visitor);  //都有一个方法accept接受访问者的实例
}

class VisitedArray implements Visited
{
    protected $elements = array();
    public function addElement($element){
        $this->elements[]=$element;
    }
    public function getSize(){
        return count($this->elements);
    }
    public function accept(Visitor $visitor){
        $visitor->visit($this);
    }
}

interface Visitor {
    public function visit(VisitedArray $elements);
}

class DataVisitor implements Visitor
{
    protected $info;
    public function visit(VisitedArray $visitedArray){
        $this->info = sprintf ("数组有 %d 项内容", $visitedArray->getSize());
    }
    public function getInfo(){
        return $this->info;
    }
}


// Usage example

$visitedArray = new VisitedArray();

$visitedArray->addElement('item 1');
$visitedArray->addElement('item 2');
$visitedArray->addElement('item 3');

$dataVisitor = new DataVisitor();
$visitedArray->accept($dataVisitor);
$dataVisitor->visit($visitedArray);

printf("来自访客对象的消息：%s\n", $dataVisitor->getInfo());
