<?php

namespace src\Mapper;

use src\Model\Category;

class CategoryMapper
{
    public static function entityToCategory($entity): Category
    {
        return new Category($entity["id"], $entity["name"]);
    }

    public static function entitiesToCategory(array $entities): array
    {
        $category = [];
        if(empty($entities))
            return $category;

        foreach($entities as $category){
            $users[] = CategoryMapper::entityToCategory($category);
        }

        return $category;
    }
}