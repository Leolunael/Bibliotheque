<?php

namespace src\model;

class Reading
{
    public function __construct(
        private ?string $id,
        private int $pages_lues,
        private string $temps_passé,
        private string $note_personnelle,
    ){}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getPages_lues(): int
    {
        return $this->pages_lues;
    }

    public function getTemps_passé(): string
    {
        return $this->temps_passé;
    }

    public function getNote_personnelle(): string
    {
        return $this->note_personnelle;
    }

    public function __toString(){
        return "Nombre de pages lues $this->getPages_lues(),
         temps mis $this->getTemps_passé(),
         Notes $this->getNote_personnelle().";
    }

}