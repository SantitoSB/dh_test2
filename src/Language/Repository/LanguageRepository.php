<?php

declare(strict_types=1);

namespace App\Language\Repository;

use App\Application\Exception\NotFoundException;
use App\Application\Repository\AbstractRepository;
use App\Application\ValueObject\Uuid;
use App\Language\Model\Language\Language;

/**
 * LanguageRepository.
 */
class LanguageRepository extends AbstractRepository
{
    public function add(Language $language): void
    {
        $this->entityManager->persist($language);
    }

    /**
     * @return Language[]
     */
    public function fetchAll(): array
    {
        $qb = $this->entityRepository->createQueryBuilder('l');

        return $qb->getQuery()->getResult();
    }

    public function get(int $id): Language
    {
        /** @var Language|null $model */
        $model = $this->entityRepository->findOneBy(['id'=>$id]);


        return $model;
    }

    public function delete(int $id)
    {

        $model = $this->get($id);
        $this->entityManager->remove($model);
    }

    protected function getModelClassName(): string
    {
        return Language::class;
    }
}
