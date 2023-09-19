<?php

/**
 *  high-level module must not depend on the low-level module, but they should depend on abstractions
 */

// Low level class
class MySQLConnection
{
    public function connect()
    {
        // handle the database connection
        return 'Database connection';
    }
}

class PasswordReminder
{
    private $dbConnection;

    public function __construct(MySQLConnection $dbConnection) // This is bad because PasswordReminder is now coupled with a concrete class
    {
        $this->dbConnection = $dbConnection;
    }
}

// instead we should type hint to an interface like below
interface DBConnectionInterface
{
    public function connect();
}

