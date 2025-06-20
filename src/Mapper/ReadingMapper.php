<?php

namespace src\Mapper;

use MongoDB\Driver\ObjectId;
use src\Model\Reading;

class ReadingMapper
{
    public static function documentToReading($document): Reading
    {
        return new Reading(
            $document['pages_lues'] ?? null,
            $document['temps_passe'] ?? null,
            $document['note_personnelle'] ?? null
        );
    }

    public static function documentsToReading($documents): array{
        $allReading = [];
        foreach($documents as $document){
            $allReading[] = self::documentToReading($document);
        }
        return $allReading;
    }

    public static function ReadingToDocuments(Reading $reading) : array{

        return $document = [
            'pages_lues' => $reading->getPages_lues(),
            'temps_passe' => $reading->getTemps_passe(),
            'note_personnelle' => $reading->getDate()
        ];
    }
}