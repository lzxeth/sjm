<?php

namespace sjm;
include_once(APP_ROOT.DIRECTORY_SEPARATOR.'base'.DIRECTORY_SEPARATOR.'Component.php');
include_once(APP_ROOT.DIRECTORY_SEPARATOR.'base'.DIRECTORY_SEPARATOR.'Singleton.php');

use sjm\base\Component;
use sjm\base\Singleton;

class FileDb extends Component {
    use Singleton;

    private $_filePath;
    private $_fp;



    protected function init() {
        $this->_filePath = DB_FILE;
        $this->_fp = fopen($this->_filePath, 'a+');
    }

    public function __destruct() {
        fclose($this->_fp);
    }

    public function getFilePointer() {
        return $this->_fp;
    }

    public function insert(array $row) {
        fputcsv($this->_fp, $row);

        if($this->hasEventHandlers('afterInsert')) {
            $this->trigger('afterInsert', $row);
        }
 
    }

}





