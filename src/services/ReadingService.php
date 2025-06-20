<?php

namespace src\services;

use MongoDB\Driver\Exception\Exception as MongoDBException;
use src\repository\ReadingRepository;

class ReadingService
{
    public function __construct(private ReadingRepository $readingRepository){}

    public function getReading(): array
    {
        $allReading = [];
        try {
            $allReading = $this->readingRepository->findAll();
        }catch (MongoDBException $exception){
            echo "Erreur findAll Reading : ".$exception->getMessage();
        }
        $this->displayReading($allReading);
        return $allReading;
    }

    public function clearReading(): void{
        try{
            $result = $this->ReadingRepository->clear();
            echo "$result éléments supprimés.";
        }catch (MongoDBException $exception){
            echo "Erreur clearReading : ".$exception->getMessage();
        }
    }

    public function displayReading($reading): void
    {
        foreach ($reading as $reading){
            print($reading.PHP_EOL);
        }
    }
}