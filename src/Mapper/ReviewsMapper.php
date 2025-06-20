<?php

namespace src\Mapper;

use MongoDB\Driver\ObjectId;
use src\Model\Reviews;

class ReviewsMapper
{
    public static function documentToReviews($document): Reviews
    {
        return new Reviews(
            $document['note'] ?? null,
            $document['commentaire'] ?? null,
            $document['date'] ?? null
        );
    }

    public static function documentsToReviews($documents): array{
        $allReviews = [];
        foreach($documents as $document){
            $allReviews[] = self::documentToReviews($document);
        }
        return $allReviews;
    }

    public static function ReviewsToDocuments(Reviews $reviews) : array{

        return $document = [
            'note' => $Reviews->getNote(),
            'commentaire' => $Reviews->getCommentaire(),
            'date' => $Reviews->getDate()
        ];
    }
}