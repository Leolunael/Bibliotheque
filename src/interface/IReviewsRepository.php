<?php
namespace src\interface;

use src\model\Reviews;

interface IReviewsRepository
{
    public function insert(Reviews $reviews);
    public function findAll();
    public function clear();
    public function calculerMoyenneNote(): ?float;

}