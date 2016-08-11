<?php

interface Observable
{  //被观察者
    function attach(Observer $observer);

    function detach(Observer $observer);

    function notify();
}

// ... Login class
class Login implements Observable
{
    private $observers = array();
    private $storage;
    private $status;
    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    function detach(Observer $observer)
    {
        $this->observers = array_filter($this->observers, function ($a) use ($observer) {
            return (!($a === $observer));
        });
    }

    function notify()
    {
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }

    function handleLogin($user, $pass, $ip)
    {
        switch (rand(1, 3)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $isvalid = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $isvalid = false;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $isvalid = false;
                break;
        }
        $this->notify(); //#####
        return $isvalid;
    }

    function setStatus($status, $user, $ip)
    {
        $this->status = array($status, $user, $ip);
    }

    function getStatus()
    {
        return $this->status;
    }
}


interface Observer
{
    function update(Observable $observable);
}

class SecurityMonitor implements Observer
{  //观察者
    function update(Observable $observable)
    {
        $status = $observable->getStatus();
        if ($status[0] == Login::LOGIN_WRONG_PASS) {
            // send mail to sysadmin
            print __CLASS__.":\tsending mail to sysadmin\n";
        }
    }
}

$login = new Login();
$login->attach(new SecurityMonitor());
$login->handleLogin('user', 'mima', '127.0.0.1');
