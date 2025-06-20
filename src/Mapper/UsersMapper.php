<?php

namespace src\Mapper;

use src\Model\Users;

class UsersMapper
{
    public static function entityToUsers($entity): Users
    {
        return new Users($entity["id"], $entity["name"], $entity["email"]);
    }

    public static function entitiesToUsers(array $entities): array
    {
        $users = [];
        if(empty($entities))
            return $users;

        foreach($entities as $users){
            $users[] = UsersMapper::entityToUsers($users);
        }

        return $users;
    }

}