<?php
/**
 *  Objects or entities should be open for extension but closed for modification
 */

// Below is the AreaCalculator from the Single Responsibilty Principle
class AreaCalculator
{
    protected $shapes;

    public function __construct($shapes = [])
    {
        $this->shapes = $shapes;
    }

    public function sum() // this method violates the Open Closed principle because if we want to support other shapes this would have to be modified (new Devs might not know this)
    {
        foreach ($this->shapes as $shape) {
            if (is_a($shape, 'Square')) {
                $area[] = pow($shape->length, 2);
            } elseif (is_a($shape, 'Circle')) {
                $area[] = pi() * pow($shape->radius, 2);
            }
        }

        return array_sum($area);
    }
}

// instead we could create a ShapeInterface
interface ShapeInterface
{
    public function area();
}

// And each Shape should implement this  