<?php

// should not always be the first choice
class Customer 
{
    protected $plan;
    // normally this would be fine, no need for a seperate class CustomerIsGold
    // public function isGold()
    // {
    //     return $this->type == 'gold';
    // }

    public function __construct($plan)
    {
        $this->plan = $plan;
    }

    public function plan()
    {
        return $this->plan;
    }

}

// Elevate business logic to a class

class CustomerIsGold 
{
    public function isSatisfiedBy(Customer $customer)
    {
        // logic to determine if they are a gold customer
        $customer->plan == 'gold';
    }
}

$spec = new CustomerIsGold;

// basic check to see if a customer is on gold plan
$spec->isSatisfiedBy(new Customer('gold'));

// more realistic example would be filtering results from a database
class CustomersRepository
{
    protected $customers;

    public function __construct(array $customers)
    {
        $this->customers = $customers;
    }

    public function bySpecification($specification)
    {
        $matches = [];

        foreach ($this->customers as $customer) {
            if($specification->isSatisfiedBy($customer)) {
                $matches[] = $customer;
            }
        }

        return $matches;
    }
}

$customers = new CustomersRepository([
    new Customer('gold'),
    new Customer('bronze'),
    new Customer('silver'),
    new Customer('gold'),
]);

$results = $customers->bySpecification(new CustomerIsGold);

// we are passing through the spec into a method on the repo and that handles the filtering according to the spec




