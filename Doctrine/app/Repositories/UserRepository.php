<?php

namespace App\Repositories;

use App\Entities\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    protected $entity = User::class;

    public function getUserByUsername(string $username)
    {
        return $this->_em->getRepository($this->entity)->findOneBy(["username" => $username]);
    }
}