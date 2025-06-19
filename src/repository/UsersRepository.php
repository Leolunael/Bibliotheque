<?php

namespace src\repository;

use PDO;
use src\configs\MySqlConnection;
use src\mapper\UsersMapper;
use src\model\Users;

class UsersRepository
{
    public function __construct(private PDO $db) {
    }

    public function findAll() {
        $request = "SELECT id, name,  email FROM users ORDER BY id";
        $statement = $this->db->prepare($request);

        $statement->execute();

        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        return UsersMapper::entitiesToUsers($users);
    }

    function findById(int $id): Users|false {
        $request = "SELECT id, name, email FROM Users WHERE id=:id;";
        $statement = $this->db->prepare($request);
        $statement->execute(["id" => $id]);
        $users = UsersMapper::entityToUsers($statement->fetch(PDO::FETCH_ASSOC));
        return $users;
    }

    public function save(Users $Users) {
        $request = "INSERT INTO Users (name, email)
                    VALUES (:name, :email)";

        $statement = $this->db->prepare($request);

        $statement->bindValue(":name", $users->getName());
        $statement->bindValue(":email", $users->getEmail());

        $statement->execute();

        return $statement->rowCount() === 1;
    }

    public function update(Users $usersToUpdate) {
        $request = "UPDATE users SET name=:name, email=:email WHERE id=:id;";
        $statement = $this->db->prepare($request);

        $statement->bindValue(":id", $usersToUpdate->getId());
        $statement->bindValue(":name", $usersToUpdate->getName());
        $statement->bindValue(":email", $usersToUpdate->getEmail());

        return $statement->execute();
    }

    public function deleteById($id) {
        $query = "DELETE FROM users WHERE id=:id;";
        $statement = $this->db->prepare($query);
        return $statement->execute(["id" => $id]);
    }

    public function findAllByName($input) {
        $request = "SELECT id, name, email FROM users WHERE name LIKE :input OR name LIKE :input";
        $statement = $this->db->prepare($request);
        $statement->execute([":input" => $input]);
        $students = $statement->fetchAll(PDO::FETCH_ASSOC);
        return UsersMapper::entitiesToUsers($users);
    }
}
