<?php

declare(strict_types=1);

namespace App\Application\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * AbstractRepository.
 */
abstract class AbstractRepository
{
    protected EntityManagerInterface $entityManager;

    protected EntityRepository $entityRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository($this->getModelClassName());
    }

    abstract protected function getModelClassName(): string;
}
