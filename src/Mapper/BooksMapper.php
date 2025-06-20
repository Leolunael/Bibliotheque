<?php

namespace src\Mapper;

use src\model\Books;

class BooksMapper
{
    public static function entityToBooks($entity): Books
    {
        return new Books($entity["id"], $entity["title"], $entity["author"], $entity["isbn"], $entity["users_id"]);
    }

    public static function entitiesToBooks(array $entities): array
    {
        $users = [];
        if(empty($entities))
            return $books;

        foreach($entities as $books){
            $books[] = BooksMapper::entityToBooks($books);
        }

        return $users;
    }

}