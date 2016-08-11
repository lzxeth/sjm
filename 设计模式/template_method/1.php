<?php

//这个模式就是把公共的部分放到父类，不同的放到子类
abstract class Journey {
    final public function takeATrip() {
        $this->buyAFlight();
        $this->takePlane();
        $this->enjoyVacation();//！！！
        $this->buyGift();
        $this->takePlane();
    }
    //key feature
    abstract protected function enjoyVacation();

    //optional.
    protected function buyGift() {
    }

    /**
     * This method will be unknown by subclasses (better)
     */
    private function buyAFlight() {
        echo "Buying a flight\n";
    }

    final protected function takePlane() {
        echo "Taking the plane\n";
    }
}



class CityJourney extends Journey {
    protected function enjoyVacation() {
        echo "Eat, drink, take photos and sleep\n";
    }
}

class BeachJourney extends Journey{
    protected function enjoyVacation() {
        echo "Swimming and sun-bathing\n";
    }
}

$journey = new BeachJourney();
$journey->takeATrip();
//Buying a flight
//Taking the plane
//Swimming and sun-bathing

$journey = new CityJourney();
$journey->takeATrip();
//...
