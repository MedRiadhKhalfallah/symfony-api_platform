<?php
/**
 * test test MSI
 * le fichier est cree le 06/03/2022
 * symfony-api_platform
 * PhpStorm
 */

namespace App\OpenApi;


use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\OpenApi;

class OpenApiFactory implements OpenApiFactoryInterface
{

    /**
     * @var OpenApiFactoryInterface
     */
    private $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);
        /** @var PathItem $path */
        foreach ($openApi->getPaths()->getPaths() as $key => $path) {
            if ($path->getGet() && $path->getGet()->getSummary() === "hidden") {
                $openApi->getPaths()->addPath($key, $path->withGet(null));
            }
        }
//        creation une entrée pour le login
        $schemas = $openApi->getComponents()->getSecuritySchemes();
        $schemas['cookieAuth'] = new \ArrayObject([
            'type' => 'apikey',
            'in' => 'cookie',
            'name' => 'PHPSESSID'
        ]);
//        ajouter controlle connexion sur tous les entrees
//        $openApi=$openApi->withSecurity(['cookieAuth'=>[]]);

        return $openApi;
    }
}
