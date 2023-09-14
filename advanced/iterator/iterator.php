<?php

class BasicIterator extends IteratorIterator
{
    public function __construct(string $pathToFile)
    {
        // call the parent constructor with an SplFileObject (also traversible) for given path
        parent::__construct(new SplFileObject($pathToFile, 'r'));

        // Setup the inner SplFileObject's properties to process CSV
        $file = $this->getInnerIterator();
        $file->setFlags(SplFileObject::READ_CSV);
        $file->setCsvControl(',','"',"\\");

    }
}

$filePath = './data.csv';
$iterator = new BasicIterator($filePath);
foreach($iterator as $i => $row) {
    var_dump($row);
}