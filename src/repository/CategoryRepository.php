<?php

namespace src\repository;

use PDO;
use src\configs\MySqlConnection;
use src\mapper\CategoryMapper;
use src\model\Category;

class BooksRepository
{
    public function __construct(private PDO $db) {
    }

    public function findAll() {
        $request = "SELECT id, name FROM category ORDER BY id";
        $statement = $this->db->prepare($request);

        $statement->execute();

        $category = $statement->fetchAll(PDO::FETCH_ASSOC);

        return CategoryMapper::entitiesToCategory($category);
    }

    public function save(Category $category) {
        $request = "INSERT INTO category (id, name)
                    VALUES (:name)";

        $statement = $this->db->prepare($request);

        $statement->bindValue(":name", $category->getName());

        $statement->execute();

        return $statement->rowCount() === 1;
    }

    public function deleteById($id) {
        $query = "DELETE FROM category WHERE id=:id;";
        $statement = $this->db->prepare($query);
        return $statement->execute(["id" => $id]);
    }

}