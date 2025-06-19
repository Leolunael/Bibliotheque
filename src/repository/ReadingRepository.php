<?php

namespace src\repository;

use MongoDB\Collection;
use src\configs\MongoConnection;
use src\interface\IReadingRepository;
use src\mapper\ReadingMapper;
use src\model\Reading;

class ReadingRepository implements IReadingRepository
{
    private Collection $collection;

    public function __construct(){
        $this->collection = MongoConnection::getMongoCollection("Reading", "reading");
    }

    public function insert(Reading $reading){
        $document = ReadingMapper::logToDocument($reading);
        $result = $this->collection->insertOne($document);
        return $result->getInsertedId()?->__toString();
    }

    public function findAll(int $limit = 0): array{
        $cursor = $this->collection->find([], $limit > 0 ? ['limit' => $limit] : []);
        return ReadingMapper::documentsToReading($cursor);
    }

    public function clear(): int{
        $deleteResult = $this->collection->deleteMany([]);
        return $deleteResult->getDeletedCount();
    }
}