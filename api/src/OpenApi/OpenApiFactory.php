<?php

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\OpenApi;

class OpenApiFactory implements OpenApiFactoryInterface
{
    public function __construct(private OpenApiFactoryInterface $decorated)
    {
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);//permet de récupérer l'OpenApi décoré

        //permet de supprimer un summary donné dans l'OpenApi
        foreach ($openApi->getPaths()->getPaths() as $path => $pathItem) {//on récupère les paths
            if ($pathItem->getGet() && $pathItem->getGet()->getSummary() === 'hidden') {//on récupère les paths dont le summary est 'hidden'
                $openApi->getPaths()->addPath($path, $pathItem->withGet(null));//on supprime le get
            }
            
            // remove identifier parameter from operations which include "#withoutIdentifier" in the description
            foreach (PathItem::$methods as $method) {
                $getter = 'get'.ucfirst(strtolower($method));
                $setter = 'with'.ucfirst(strtolower($method));
                /** @var Operation $operation */
                $operation = $pathItem->$getter();
                if ($operation && preg_match('/#withoutIdentifier/', $operation->getDescription())) {
                    /** @var Parameter[] $parameters */
                    $parameters = $operation->getParameters();
                    foreach ($parameters as $i => $parameter) {
                        if (preg_match('/identifier/i', $parameter->getDescription())) {
                            unset($parameters[$i]);
                            break;
                        }
                    }
                    $openApi->getPaths()->addPath($path, $pathItem = $pathItem->$setter($operation->withParameters(array_values($parameters))));
                }
            }
        }

        return $openApi;
    }
}

