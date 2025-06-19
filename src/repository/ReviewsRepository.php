<?php

namespace src\repository;

use MongoDB\Collection;
use src\configs\MongoConnection;
use src\interface\IReviewsRepository;
use src\mapper\ReviewsMapper;
use src\model\Reviews;

class ReviewsRepository implements IReviewsRepository
{
    private Collection $collection;

    public function __construct(){
        $this->collection = MongoConnection::getMongoCollection("Reviews", "reviews");
    }

    public function insert(Reviews $reviews){
        $document = ReviewsMapper::logToDocument($reviews);
        $result = $this->collection->insertOne($document);
        return $result->getInsertedId()?->__toString();
    }

    public function findAll(int $limit = 0): array{
        $cursor = $this->collection->find([], $limit > 0 ? ['limit' => $limit] : []);
        return ReviewsMapper::documentsToReviews($cursor);
    }

    public function clear(): int{
        $deleteResult = $this->collection->deleteMany([]);
        return $deleteResult->getDeletedCount();
    }
}