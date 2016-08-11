<?php
class ObjectCollection {
    private $elements;
    private $comparator;
    public function __construct(array $elements = array()) {
        $this->elements = $elements;
    }
    public function sort() {
        if (!$this->comparator) {
            throw new LogicException("Comparator is not set");
        }

        $callback = array($this->comparator, 'compare');
        uasort($this->elements, $callback);

        return $this->elements;
    }

    public function setComparator(ComparatorInterface $comparator) {
        $this->comparator = $comparator;
    }
}


interface ComparatorInterface {
    public function compare($a, $b);
}
class DateComparator implements ComparatorInterface {
    public function compare($a, $b) {
        $aDate = new DateTime($a['date']);
        $bDate = new DateTime($b['date']);

        if ($aDate == $bDate) {
            return 0;
        } else {
            return $aDate < $bDate ? -1 : 1;
        }
    }
}



$collection = array(
        array('date' => '2014-03-03', 'id'=>3),
        array('date' => '2015-03-02', 'id'=>2),
        array('date' => '2013-03-01', 'id'=>1)
);
$obj = new ObjectCollection($collection);
$obj->setComparator(new DateComparator());
$elements = $obj->sort();

print_r($elements);
