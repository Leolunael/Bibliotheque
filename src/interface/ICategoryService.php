<?php

namespace src\interface;

use src\model\Category;

interface ICategoryService
{
    function createCategory(Category $categoryToSave): bool;
}