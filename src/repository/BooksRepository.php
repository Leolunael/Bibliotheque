<?php

namespace src\repository;

use PDO;
use src\configs\MySqlConnection;
use src\mapper\BooksMapper;
use src\model\Books;

class BooksRepository
{
    public function __construct(private PDO $db) {
    }

    public function findAll() {
        $request = "SELECT id, title, author, isbn, user_id FROM books ORDER BY id";
        $statement = $this->db->prepare($request);

        $statement->execute();

        $books = $statement->fetchAll(PDO::FETCH_ASSOC);

        return BooksMapper::entitiesToBooks($books);
    }

    function findById(int $id): Books|false {
        $request = "SELECT id, title, author, isbn, user_id FROM books WHERE id=:id;";
        $statement = $this->db->prepare($request);
        $statement->execute(["id" => $id]);
        $books = BooksMapper::entityToBooks($statement->fetch(PDO::FETCH_ASSOC));
        return $books;
    }

    public function save(Books $books) {
        $request = "INSERT INTO books (title, author, isbn, user_id)
                    VALUES (:title, :author, :isbn, :user_id)";

        $statement = $this->db->prepare($request);

        $statement->bindValue(":title", $books->getTitle());
        $statement->bindValue(":author", $books->getAuthor());
        $statement->bindValue(":isbn", $books->getIsbn());
        $statement->bindValue(":user_id", $books->getUser_id());

        $statement->execute();

        return $statement->rowCount() === 1;
    }

    public function update(Books $booksToUpdate) {
        $request = "UPDATE books SET title=:title, author=:author, isbn=:isbn, user_id=:user_id  WHERE id=:id;";
        $statement = $this->db->prepare($request);

        $statement->bindValue(":id", $booksToUpdate->getId());
        $statement->bindValue(":title", $booksToUpdate->getTitle());
        $statement->bindValue(":author", $booksToUpdate->getAuthor());
        $statement->bindValue(":isbn", $booksToUpdate->getIsbn());
        $statement->bindValue(":user_id", $booksToUpdate->getUser_id());

        return $statement->execute();
    }

    public function deleteById($id) {
        $query = "DELETE FROM books WHERE id=:id;";
        $statement = $this->db->prepare($query);
        return $statement->execute(["id" => $id]);
    }

    public function findAllByName($input) {
        $request = "SELECT id, title, author, isbn, user_id FROM books WHERE title LIKE :input OR author LIKE :input";
        $statement = $this->db->prepare($request);
        $statement->execute([":input" => $input]);
        $students = $statement->fetchAll(PDO::FETCH_ASSOC);
        return BooksMapper::entitiesToBooks($books);
    }
}