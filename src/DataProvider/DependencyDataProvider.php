<?php
/**
 * test test MSI
 * le fichier est cree le 07/03/2022
 * symfony-api_platform
 * PhpStorm
 */

namespace App\DataProvider;


use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Dependency;

class DependencyDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface, ItemDataProviderInterface
{
    /**
     * @var string
     */
    private $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
    }

    private function getDepencencies(): array
    {
        $path = $this->rootPath . '/composer.json';
        $json = json_decode(file_get_contents($path), true);
        return $json['require'];
    }

    /**
     * @inheritDoc
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $items = [];
        foreach ($this->getDepencencies() as $name => $version) {
            $dependency = new Dependency();
            $dependency->setId(count($items) + 1);
            $dependency->setName($name);
            $dependency->setVersion(json_encode($version));
            $items[] = $dependency;
        }
        return $items;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Dependency::class;
    }

    /**
     * @inheritDoc
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        $depencencies = $this->getDepencencies();
        $items = [];
        foreach ($depencencies as $name => $version) {
            $dependency = new Dependency();
            $dependency->setId(count($items) + 1);
            $dependency->setName($name);
            $dependency->setVersion(json_encode($version));
            $items[] = $dependency;
            if (count($items) === $id) {
                return $dependency;
            }
        }
        return "null";

    }
}
