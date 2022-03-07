<?php
/**
 * test test MSI
 * le fichier est cree le 07/03/2022
 * symfony-api_platform
 * PhpStorm
 */

namespace App\DataPersister;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Dependency;
use App\Repository\DependencyRepository;

class DependencyDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var DependencyRepository
     */
    private $dependencyRepository;

    public function __construct(DependencyRepository $dependencyRepository)
    {
        $this->dependencyRepository = $dependencyRepository;
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Dependency;
    }

    /**
     * @param Dependency $data
     * @param array $context
     * @return object|void
     */
    public function persist($data, array $context = [])
    {
        //todo update
      return $this->dependencyRepository->save($data);
    }

    /**
     * @inheritDoc
     */
    public function remove($data, array $context = [])
    {
        //todo delete
        return $this->dependencyRepository->delete($data);
    }
}
