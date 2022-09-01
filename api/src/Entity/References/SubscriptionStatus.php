<?php

namespace App\Entity\References;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\References\Reference;
use App\Filter\WorkforceFilter;

// #[ApiResource(
//     collectionOperations: [
//         'get' => [
//             'method' => 'GET',
//             'openapi_context' => [
//                 'tags' => ['References'],
//             ],
//         ],
//     ],
//     itemOperations: [
//         'get' => [
//             'controller' => NotFoundAction::class,
//             'read' => false, // pour supprimer la lecture
//             'output' => false, // pour supprimer la sortie
//             'openapi_context' => [
//                 'summary' => 'hidden', //Indique le summary à supprimer avec openapiFactory  
//             ]
//         ],
//     ]
// )]
class SubscriptionStatus extends Reference
{
    const ACTIVE = 'active';
    const UNSUBSCRIBED = 'unsubscribed';

    const STATUSES = [
        [
            'slug' => self::ACTIVE,
            'label' => 'Actif',
        ],
        [
            'slug' => self::UNSUBSCRIBED,
            'label' => 'Désinscrit',
        ],
    ];
}