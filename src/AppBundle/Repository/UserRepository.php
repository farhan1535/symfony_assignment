<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\OptimisticLockException;

class UserRepository extends EntityRepository
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var Mapping\ClassMetadata
     */
    private $class;

    /**
     * UserRepository constructor.
     * @param EntityManager $em
     * @param Mapping\ClassMetadata $class
     */
    public function __construct(EntityManager $em, Mapping\ClassMetadata $class)
    {
        $this->em = $em;
        $this->class = $class;
        parent::__construct($this->em, $this->class);
    }

    public function insert(User $user)
    {
        $this->em->persist($user);
        try {
            $this->em->flush();
            return true;
        } catch (OptimisticLockException $e) {
            return false;
        }
    }

    public function editUser(User $user)
    {
        try {
            $this->em->flush();
        } catch (OptimisticLockException $e) {
        }
    }

    public function deleteById($id)
    {
        $query = $this->createQueryBuilder('u')
            ->delete('AppBundle:User', 'u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
        $query->execute();
    }
}