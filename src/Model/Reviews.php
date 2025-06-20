<?php

namespace src\model;

use DateTime;

class Reviews
{
    public function __construct(
        private ?string $id,
        private int $note,
        private string $commentaire,
        private datetime $date,
    ){}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNote(): float
    {
        return $this->note;
    }

    public function getCommentaire(): string
    {
        return $this->commentaire;
    }

    public function getDate(): datetime
    {
        return $this->date;
    }

    public function __toString(){
        return "la note mise est $this->getNote(),
         Le commentaire laissé est $this->getCommentaire(),
         Le $this->getDate().";
    }

}