<?php

declare(strict_types=1);

namespace App\Data;

use Doctrine\ORM\EntityManagerInterface;

/**
 * TransactionManager.
 */
class TransactionManager
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function beginTransaction(): void
    {
        $this->entityManager->beginTransaction();
    }

    public function commit(): void
    {
        $this->entityManager->commit();
    }

    public function rollBack(): void
    {
        $this->entityManager->rollback();
    }
}
