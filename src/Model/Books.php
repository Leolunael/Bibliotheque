<?php

namespace src\model;

class Books{
    public function __construct(
        private ?int $id,
        private string $title,
        private string $author,
        private string $isbn,
        private string $users_id
    ){}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getUsers_Id(): string
    {
        return $this->users_id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function setUsers_Id(string $users_Id): void
    {
        $this->users_Id = $users_Id;
    }

    public function __toString(){
        return "Book n°$this->id : $this->title, ISBN : $this->isbn, possédé par : $this->users_id.";
    }
}