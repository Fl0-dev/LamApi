<?php

namespace App\OpenApi;

use ApiPlatform\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\PathItem;
use ApiPlatform\OpenApi\Model\RequestBody;
use ApiPlatform\OpenApi\OpenApi;

class OpenApiFactory implements OpenApiFactoryInterface
{
    public function __construct(private OpenApiFactoryInterface $decorated)
    {
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        $schemas = $openApi->getComponents()->getSecuritySchemes();
        $schemas['coockieAuth'] = new \ArrayObject([
            'type' => 'apiKey',
            'in' => 'cookie',
            'name' => 'PHPSESSID',
        ]);
        $openApi = $openApi->withSecurity([['coockieAuth' => []]]);

        // //Autentification avec JWT
        // $schemas = $openApi->getComponents()->getSecuritySchemes();
        // $schemas['bearerAuth'] = new \ArrayObject([
        //     'type' => 'http',
        //     'scheme' => 'bearer',
        //     'bearerFormat' => 'JWT',
        // ]);


        // //Route pour récupérer le JWT
        // $schemas['Token'] = new \ArrayObject([
        //     'type' => 'object',
        //     'properties' => [
        //         'token' => [
        //             'type' => 'string',
        //             'readOnly' => true,
        //         ],
        //     ],
        // ]);

        // $pathItem = new PathItem(
        //     ref: 'JWT Token',
        //     post: new Operation(
        //         operationId: 'postCredentialsItem',
        //         tags: ['Token'],
        //         responses: [
        //             '200' => [
        //                 'description' => 'Get JWT token',
        //                 'content' => [
        //                     'application/json' => [
        //                         'schema' => [
        //                             '$ref' => '#/components/schemas/Token',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         summary: 'Get JWT token to login.',
        //         requestBody: new RequestBody(
        //             description: 'Generate new JWT Token',
        //             content: new \ArrayObject([
        //                 'application/json' => [
        //                     'schema' => [
        //                         '$ref' => '#/components/schemas/Credentials',
        //                     ],
        //                 ],
        //             ]),
        //         ),
        //     ),
        // );
        // $openApi->getPaths()->addPath('/api/authentication_token', $pathItem);

        //création d'un schéma pour autentification
        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['Credentials'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'username' => [
                    'type' => 'string',
                    'example' => 'admin@gmail.com',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'password',
                ],
            ],
        ]);

        $pathItem = new PathItem(
            post: new Operation(
                operationId: 'postApiLogin',
                tags: ['User'],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Credentials',
                            ],
                        ]
                    ])
                ),
                responses: [
                    '200' => [
                        'description' => 'User connected',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/User-getUserInfo',
                                ],
                            ],
                        ],
                    ],
                ]
            )
        );

        $openApi->getPaths()->addPath('/api/login', $pathItem);

        $pathItem = new PathItem(
            post: new Operation(
                operationId: 'postApiLogout',
                tags: ['User'],
                responses: [
                    '204' => [],
                ]
            )
        );

        $openApi->getPaths()->addPath('/api/logout', $pathItem);

        return $openApi;
    }
}
