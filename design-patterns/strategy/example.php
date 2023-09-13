<?php 

interface Logger {
    public function log($data);
}

// Family of Algorithms that we want to use intervhangeably at runtime in order to achieve this they must implement a common interface

class LogToFile implements Logger {

    public function log($data) 
    {
        var_dump('Logging to file');
    }
}

class LogToDatabase implements Logger {

    public function log($data) 
    {
        var_dump('Logging to database');
    }
}

class LogToWebService implements Logger {

    public function log($data) 
    {
        var_dump('Logging to a Saas site');
    }
}

// Client code that consumes the algorithm, we use DI to swap out different implementations

class App {
    public function log($data, Logger $logger) 
    {
        $logger->log($data);
    }
}

$app = new App;

$app->log('Some info', new LogToDatabase); // we can swap out the LogToDatabase with other options
