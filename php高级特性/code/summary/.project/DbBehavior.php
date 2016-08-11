<?php

namespace sjm;

include_once(APP_ROOT.DIRECTORY_SEPARATOR.'base'.DIRECTORY_SEPARATOR.'Behavior.php');

use sjm\base\Behavior;

class DbBehavior extends Behavior {
    
    public function getFirstRecord() {
        $fp = $this->owner->getFilePointer();
        $pos = ftell($fp);
        rewind($fp);
        $firstLine = fgets($fp);
        fseek($fp, $pos);
        return $firstLine;
    }

    public function onAfterInsert($row) {
        echo "Inserted (From ".__CLASS__.")\n";
    }


}



