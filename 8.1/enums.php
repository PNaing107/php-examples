<?php

/* Enums are handy when we have a set number of options */
enum Compass: string 
{
    case North = 'north';
    case East = 'east';
    case South = 'south';
    case West = 'west';

    // we can also add functionality
    public function asIcon()
    {
        return match ($this) {
            self::North => '^',
            self::East => '>',
            self::South => '\/',
            self::West => '<'
        };
    }
}

var_dump(Compass::North->name); // North
var_dump(Compass::North->value); // north
var_dump(Compass::South->asIcon());

