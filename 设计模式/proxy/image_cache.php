<?php
/**
 * Proxy design pattern (lazy loading)
 *
 * @author Enrico Zimuel (enrico@zimuel.it)
 * @see    http://en.wikipedia.org/wiki/Proxy_pattern
 */
interface ImageInterface
{
    public function display();
}
class Image implements ImageInterface
{
    protected $filename;
    public function  __construct($filename) {
        $this->filename = $filename;
        $this->loadFromDisk();
    }
    protected function loadFromDisk() {
        echo "Loading {$this->filename}\n";
    }
    public function display() {
        echo "Display {$this->filename}\n";
    }
}
class ProxyImage implements ImageInterface
{
    protected $id;
    protected $image;
	protected $filename;
	
    public function  __construct($filename) {
        $this->filename = $filename;
    }
    public function display() {
        if (null === $this->image) {
            $this->image = new Image($this->filename);  //实现了延迟加载，Image是实例化时就执行了loadFromDisk，
			                                            //  从磁盘载入内存，这个类是在display是才加载
        }
        return $this->image->display();
    }
}
// Usage example
//image类是实例化时就把图片从磁盘载入内存
$filename = 'test.png';
$image1 = new Image($filename); // loading necessary
echo $image1->display(); // loading unnecessary

//代理类是在display时才把图片从磁盘加入内存
$image2 = new ProxyImage($filename); // loading unnecessary
echo $image2->display(); // loading necessary
echo $image2->display(); // loading unnecessary
