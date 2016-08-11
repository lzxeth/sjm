<?php
class obj 
{
    private $container = array();

    public function __construct()
    {
        $this->container = array(
            "one" => 1,
            "two" => 2,
            "three" => 3,
        );
    }

    //检查一个偏移位置是否存在
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    //获取一个偏移位置的值
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    //设置一个偏移位置的值
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    //复位一个偏移位置的值
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

}

$obj = new obj;
$obj[] = 'Append 1';
$obj[] = 'Append 2';
$obj[] = 'Append 3';
print_r($obj);

var_dump(isset($obj["two"]));

var_dump($obj["two"]);

unset($obj["two"]);
var_dump(isset($obj["two"]));

$obj["two"] = "A value";
var_dump($obj["two"]);





