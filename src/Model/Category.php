<?php

namespace src\model;

class Books{
    public function __construct(
        private ?int $id,
        private string $name
    ){}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function __toString(){
        return "Book n°$this->id : $this->title, ISBN : $this->isbn, possédé par : $this->users_id.";
    }
}