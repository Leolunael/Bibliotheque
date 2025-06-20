<?php

namespace src\interface;

use src\model\Books;

interface IBooksService
{
    function createBooks(Books $booksToSave): bool;
}
