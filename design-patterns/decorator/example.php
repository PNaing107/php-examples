<?php

// A.k.a Wrapper pattern - allows us to extend the behaviour of a core class dynamically (i.e. at runtime)

interface IceCream {
    public function cost();
}

// The base class or object which contains the fundamental functionality.
class StandardIceCream implements IceCream {

    public function cost()
    {
        return 2.5;
    }
}

// Decorators are like toppings you can add to your ice cream. They enhance the core object without altering its base structure.

abstract class IceCreamDecorator implements IceCream {
    protected $iceCream;

    public function __construct(IceCream $iceCream) {
        $this->iceCream = $iceCream;
    }
}

class ChocolateSyrup extends IceCreamDecorator {
    public function cost() {
        return $this->iceCream->cost() + 0.5; // Cost of adding chocolate syrup
    }
}

class Sprinkles extends IceCreamDecorator {
    public function cost() {
        return $this->iceCream->cost() + 0.3; // Cost of adding sprinkles
    }
}

// Now, you can create your custom ice cream by stacking decorators on top of the basic ice cream.

$standardIceCream = new StandardIceCream();
$iceCreamWithChocolateSyrup = new ChocolateSyrup($basicIceCream);
$deluxeIceCream = new Sprinkles($iceCreamWithChocolateSyrup);

echo "Cost of Deluxe Ice Cream: $" . $deluxeIceCream->cost();
