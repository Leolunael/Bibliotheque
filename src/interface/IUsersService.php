<?php

namespace src\interface;

use src\model\Users;

interface IUsersService
{
    function createUsers(Users $usersToSave): bool;
}