<?php

/* array unpacking (an alternative for array merge) */

$attributes = [
    'title' => 'My Blog Post',
    'body' => 'Lorem ipsum.'
];

$additional_attribute = ['category_id' => 1];

$newArray = [...$attributes, ...$additional_attribute];

/* new never return type */
function visit($url): never
{
    header('Location:');
}

/* Constructor initializer - set a default concrete class if one isn't provided */
interface Newsletter
{
    public function subscribe($list);
}

class MailChimpNewsletter implements Newsletter
{
    public function subscribe($list)
    {
        var_dump('testing');
    }
}

class Signup
{
    public function perform(Newsletter $newsletter = new MailChimpNewsletter) // use MailChimp if a Newsletter is not provided
    {
        $newsletter->subscribe('somelist');
    }
}

/* Readonly properties - no need for protected property + Getter */
class Project
{
    public function __construct(public readonly string $uid)
    {
        
    }
}

var_dump((new Project('abc123'))->uid); // should print out "abc123"
