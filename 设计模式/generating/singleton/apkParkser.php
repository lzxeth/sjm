<?php
/*

apk文件解析：拿到一个安卓的apk文件然后解析
单例模式也可以把处理时间长的缓存起来
这个getPackageName方法解析包名时间太长，先用多例模式把路径缓存起来
*/
class ApkParser {
	private static $_instances = array();
	private $_apkPath;
    private $_packageName;
    private $_apkMd5;

	
	public static function getInstance($apkPath) {
		if(isset(self::$_instances[$apkPath])) {
			return self::$_instances[$apkPath];
		} else {
			$model = self::$_instances[$apkPath] = new ApkParser($apkPath);
			return $model;
		}
	}
	
	private function __construct($apkPath) {
		$this->_apkPath = $apkPath;
	}
	
	

    /**
     * ah..
     * @return string package name.
     * @throws CException
     */
    public function getPackageName() {
        if($this->_packageName === null) {

            @exec(sprintf(Yii::app()->params['getPackageNameCmd'], $this->_apkPath), $cmdResult, $returnCode);
            $cmdResult = implode("\n", $cmdResult);
            $pattern = "/package: name='(.*)'/iU";
            preg_match($pattern, $cmdResult, $matchResult);

            if (!$matchResult) {
                throw new CException("Failed to get package name of {$this->_apkPath}. error: {$returnCode}");
            }

            $this->_packageName = substr(trim($matchResult[1]), 0, 100);
        }
        return $this->_packageName;
    }

    public function getApkMd5() {
        if($this->_apkMd5 === null) {
            $this->_apkMd5 = md5_file($this->_apkPath);
        }
        return $this->_apkMd5;
    }
    
}
