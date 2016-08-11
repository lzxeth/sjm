<?php
#6、对象转为数组
//整数属性不可访问；
//私有变量前会加上类名作前缀；
//保护变量前会加上一个 '*' 做前缀。
//这些前缀的前后都各有一个 NULL 字符。
class User{
	public $name='andy';
	public $age=52;
    private $phone='138XXXXXXXX';
	protected $locaton='hongkong';
    
    public function __construct()
    {
        $this->test = 'test';
    }
}

var_dump((array) new User());

