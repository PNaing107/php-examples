<?php

interface Publisher
{
 public function attach(Subscriber $subscriber);

 public function detach($subscriber);

 public function notify();

}

interface Subscriber
{
    public function handle();
}

class Login implements Publisher
{
    protected $subscribers = [];

    public function attach(Subscriber $subscribers)
    {
        if (is_array($subscribers)) {
            foreach ($subscribers as $subscriber) {
                $this->attach($subscriber);
            }
            return;
        }

        $this->subscribers[] = $subscribers;
    }

    public function detach($index)
    {
        unset($this->subscribers[$index]);
    }

    public function notify()
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->handle();
        }
    }

    public function fire()
    {
        // perform the login and notify any subscribers
        $this->notify()
    }
}

class LogHandler implements Subscriber
{
    public function handle()
    {
        var_dump('log something important...');
    }
}

class EmailHandler implements Subscriber
{
    public function handle()
    {
        var_dump('fire off an email');
    }
}

// Client Code
$login = new Login;
$login->attach(new LogHandler);
$login->attach(new EmailHandler);
$login->fire();