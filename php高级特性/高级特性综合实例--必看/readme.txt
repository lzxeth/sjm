高级特性综合实例：

这个是高级特性summary中的5.php的例子。
把里边的类用命名空间的方式分开。
Component  Singleton    Behavior  类放到了base目录下，注意理解。
在根目录下index.php中定义spl_autoload_register自动注册函数，好好看一下。

一个关于抛出异常的注意点（在FileDb.php文件中）：
fopen：为移植性考虑，强烈建议在用 fopen() 打开文件时总是使用 "b" 标记。看手册解释。
fopen打开失败会报错，（要抑制报错@）同时返回false。
所以给fopen添加异常处理时：
if( $fp = @fopen( 'a.txt', 'a+' ) === false ){
	throw new Exception(...);
}
同时注意：
捕获异常不要在抛出下边捕获，FileDb类只负责抛出，捕获在调用这个类的地方捕获。本例中在index.php中20行捕获。
其实最早用到这个异常的的地方是FileDb类的init()方法（trait Singleton中在construct方法时调用了init），但是这个方法没有捕获，
异常就会向上冒，然后冒到getInstance方法，因为new static()是在这个方法中的。
