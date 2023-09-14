<?php

// This is like a DTO which could come from a form or DB

class HomeStatus 
{
    public $alarmOn = true;
    public $locked = true;
    public $lightsOff = true;
}


abstract class HomeChecker 
{
 protected $successor;

 public function succedWith(HomeChecker $homeChecker)
 {
    $this->successor = $homeChecker;
 }

 public function next(HomeStatus $home)
 {
    if($this->successor)
    {
        $this->successor->check($home);
    }
 }

 public abstract function check(HomeStatus $home) // each subclass will perform it's own chieck before passing onto the next class

}

class Lock extends HomeChecker
{
    public function check(HomeStatus $home)
    {
        if(! $home->locked)
        {
            throw new Exception('The doors are not locked!');
        }

        $this->next($home);
    }
}

class Alarm extends HomeChecker
{
    public function check(HomeStatus $home)
    {
        if(! $home->alarmOn)
        {
            throw new Exception('The alarm is not on!');
        }

        $this->next($home);
    }
}

class Lights extends HomeChecker
{
    public function check(HomeStatus $home)
    {
        if(! $home->lightsOff)
        {
            throw new Exception('The lights are not off!');
        }

        $this->next($home);
    }
}

// CLient code

// Set up the instances in the 'chain'
$locks = new Lock;
$lights = new Lights;
$alarm = new Alarm;

// Set up the chain of command
$lock->succedWith($lights);
$lights->succedWith($alarm);