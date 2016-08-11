<?php
class Observable
{
    /**
     * @var array Map<string eventName, List<Closure observer>> $_observers
     */
    protected $_observers = array();
 
    /**
     * @param string $eventName
     * @param array $data
     */
    protected final function _fireEvent($eventName, array $data = null)
    {
        if (isset($this->_observers[$eventName]))
        {
            foreach ($this->_observers[$eventName] as $observer)
            {
                $observer($data);
            }
        }
    }
 
    /**
     * @param string $eventName
     * @param Closure $observer With parameter (array $data)
     */
    public final function addObserver($eventName, Closure $observer)
    {
        if (!isset($this->_observers[$eventName]))
        {
            $this->_observers[$eventName] = array();
        }
        $this->_observers[$eventName][] = $observer;
    }
 
    /**
     * @param string $eventName
     * @param Closure $observer The observer to remove
     */
    public final function removeObserver($eventName, Closure $observer)
    {
        if (isset($this->_observers[$eventName]))
        {
            foreach ($this->_observers[$eventName] as $key => $existingObserver)
            {
                if ($existingObserver === $observer)
                {
                    unset($this->_observers[$eventName][$key]);
                }
            }
        }
    }
 
}


class Person extends Observable
{
    protected $_name;
    protected $_friends = array();
 
    public function __construct($name)
    {
        $this->_name = $name;
    }
 
    public function getName()
    {
        return $this->_name;
    }
 
    public function getIntroducedTo(Person $person)
    {
        $this->_friends[] = $person;
        $this->_fireEvent('introduced', array('other' => $person, 'me' => $this));
    }
 
}
 
$sally = new Person('Sally');
$sally->addObserver('introduced', function(array $data) {
        echo 'Hi, ' . $data['other']->getName() . ', my name is '.$data['me']->getName() . '.';
});
 
$sally->getIntroducedTo(new Person('Harry'));


