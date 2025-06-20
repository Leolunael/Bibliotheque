<?php
namespace src\interface;

use src\model\Reading;

interface IReadingRepository
{
    public function insert(Reading $reading);
    public function findAll();
    public function clear();
}