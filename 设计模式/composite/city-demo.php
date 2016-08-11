<?php   

/*
组合模式不管是叶子节点还是叶节点肯定要是都继承一个父类
*/
abstract class MenuComponent  //共同的一个父类
{  
    public function add($component){}  
    public function remove($component){}  
    public function getName(){}  
    public function getUrl(){}  
    public function displayOperation(){}  
}  
/** 
 * 树枝构件角色（Composite） 
 * 
 */  
class MenuComposite extends MenuComponent  
{  
    private $_items = array();  
    private $_name = null;  
	
    public function __construct($name) {  
        $this->_name = $name;  
    }  
    public function add($component) {  
        $this->_items[$component->getName()] = $component;  
    }  
    public function remove($component) {  
        $key = array_search($component,$this->_items);  
        if($key !== false) unset($this->_items[$key]);  
    }  
    public function getItems() {  
        return $this->_items;  
    }  
      
    public function displayOperation($prefix='|') {  

        if($this->getItems()) {  
            $prefix .= ' _ _ ';  
        }else{  
            $prefix .='';  
        }  
        echo $this->_name, " <br />\n";
        foreach($this->_items as $name=> $item) {  
            echo $prefix;  
            $item->displayOperation($prefix);  
        }  
    }  
  
    public function getName(){  
        return $this->_name;  
    }  
}  
  
/** 
 *树叶构件角色(Leaf) 
 * 
 */  
class ItemLeaf extends MenuComponent  
{  
    private $_name = null;  
    private $_url = null;  

    public function __construct($name,$url)  
    {  
        $this->_name = $name;  
        $this->_url = $url;  
    }  
  
    public function displayOperation($prefix='')  
    {  
        echo '<a href="', $this->_url, '">' , $this->_name, "</a><br />\n";
    }  
  
    public function getName(){  
        return $this->_name;  
    }  
}  
  



$bj = new MenuComposite("北京"); 

$cy = new ItemLeaf("朝阳区","chaoyang.com"); 
$hd = new ItemLeaf("海淀区","haidian.com"); 
  
$bj->add($cy); 
$bj->add($hd); 

$yn = new MenuComposite("云南"); 
$zt = new MenuComposite("昭通市");
$sj = new ItemLeaf("绥江县", "suijiang.gov.cn");

$zt->add($sj);
$yn->add($zt);

$sd = new MenuComposite("山东");  
$sd->add(new ItemLeaf("济南", "jinan.gov.cn"));

  
$allMenu = new MenuComposite("中国");  
$allMenu->add($bj);  
$allMenu->add($yn);  
$allMenu->add($sd);


$allMenu->displayOperation();  


// 只显示云南的
$yn->displayOperation();

