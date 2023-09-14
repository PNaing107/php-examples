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
        $file->setCsvControl(',', '"', "\\");
    }
}

class FilterRows extends FilterIterator
{
    public function accept()
    {
        $current = $this->getInnerIterator()->current();

        if (count($current) == 1) {
            return false;
        }

        return true;
    }
}

$filePath = './data.csv';
$iterator = new BasicIterator($filePath);
$iterator = new FilterRows($iterator); // we have chained the FilterRows iterator on to the BasicIterator
foreach ($iterator as $i => $row) {
    var_dump($row);
}
