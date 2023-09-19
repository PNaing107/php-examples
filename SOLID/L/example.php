<?php

/**
 * every subclass or derived class should be substitutable for their base or parent class
 */

require_once '../S/example.php';

class VolumeCalculator extends AreaCalculator
{
    public function construct($shapes = [])
    {
        parent::construct($shapes);
    }

    public function sum()
    {
        // logic to calculate the volumes and then return an array of output
        return ['$summedData'];
        // this violates the Liskov substituion principle because now the sum() method works differently depending on what type of calulator you use which means the SumCalculatorOutputter will break
    }
}
