<?php

namespace src\services;

use MongoDB\Driver\Exception\Exception as MongoDBException;
use src\repository\ReviewsRepository;

class ReviewsService
{
    public function __construct(private ReviewsRepository $reviewsRepository){}

    public function getReviews(): array
    {
        $allReviews = [];
        try {
            $allReviews = $this->ReviewsRepository->findAll();
        }catch (MongoDBException $exception){
            echo "Erreur findAll Reviews : ".$exception->getMessage();
        }
        $this->displayReviews($allReviews);
        return $allReviews;
    }

    public function clearReviews(): void{
        try{
            $result = $this->reviewsRepository->clear();
            echo "$result éléments supprimés.";
        }catch (MongoDBException $exception){
            echo "Erreur clearReviews : ".$exception->getMessage();
        }
    }

    public function displayReviews($reviews): void
    {
        foreach ($reviews as $reviews){
            print($reviews.PHP_EOL);
        }
    }
}