<?php

/**
 * A class should have one and only one reason to change, meaning that a class should have only one job.
 */

class Square
{
    public $length;

    public function construct($length)
    {
        $this->length = $length;
    }
}

class Circle
{
    public $radius;

    public function construct($radius)
    {
        $this->radius = $radius;
    }
}

class AreaCalculator
{
    protected $shapes;

    public function __construct($shapes = [])
    {
        $this->shapes = $shapes;
    }

    public function sum()
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

    public function output()
    {
        return implode('', [
            '',
            'Sum of the areas of provided shapes: ',
            $this->sum(),
            '',
        ]);
    }
}

// Client code
$shapes = [
    new Circle(2),
    new Square(5),
    new Square(6),
];

$areas = new AreaCalculator($shapes);

echo $areas->output();

/*
This is bad as the AreaCalculator handles the logic to output the data and claculate the areas of the shapes.
To address this, we can create a separate SumCalculatorOutputter class and use that new class to handle the logic you need to output the data to the user
*/

class SumCalculatorOutputter
{
    protected $calculator;

    public function __constructor(AreaCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function JSON()
    {
        $data = [
            'sum' => $this->calculator->sum(),
        ];

        return json_encode($data);
    }

    public function HTML()
    {
        return implode('', [
            '',
            'Sum of the areas of provided shapes: ',
            $this->calculator->sum(),
            '',
        ]);
    }
}

// new client code

$shapes = [
    new Circle(2),
    new Square(5),
    new Square(6),
];

$areas = new AreaCalculator($shapes);
$output = new SumCalculatorOutputter($areas);

echo $output->JSON();
echo $output->HTML();
