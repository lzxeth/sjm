<?php

class DataModel {   //导出数据，需要导出不同格式
    public function __construct($writer) {
        $this->writer = $writer;
    }

    public function export() {
        $data = array(
            array(1, 'This is cool'),
            array(2, 'Tou are handsome'),
            array(1, 'She is beautiful')
        );

        $this->writer->write($data);
    }
}


abstract class Writer {
    protected $_file;
    public function __construct($file) {
        $this->_file = $file;
    }
    abstract function write($data);
}

class CsvWriter extends Writer {

    public function write($data) {
        $fp = fopen($this->_file, 'w');
        foreach($data as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
    }
}

class HtmlWriter extends Writer {
    public function write($data) {
        $fp = fopen($this->_file, 'w');
        fwrite($fp, '<table>');
        foreach($data as $row) {
            fwrite($fp, "<tr><td>".implode("</td><td>", $row)."</td></tr>\n");
        }
        fwrite($fp, "</table>");
        fclose($fp);
    }
}

$model = new DataModel(new CsvWriter('D:\strategy.csv'));
$model->export();

