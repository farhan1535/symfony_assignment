<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;

class UserService
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getUserInfo()
    {
        return $this->userRepo->findAll();
    }

    public function setUserInfo(User $user)
    {
        return $this->userRepo->insert($user);
    }

    public function editUserInfo(User $user)
    {
        $this->userRepo->editUser($user);
    }

    public function findById($id)
    {
        return $this->userRepo->find($id);
    }

    public function removeById($id)
    {
        $this->userRepo->deleteById($id);
    }
}