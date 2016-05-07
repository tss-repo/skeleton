<?php

return [
    'tss' => [
        'authentication' => [
            'layout' => 'tss/authentication/layout/default',
            'template' => [
                'signin' => 'tss/authentication/signin',
                'signup' => 'tss/authentication/signup',
            ],
            'routes' => [
                'redirect' => [
                    'name' => 'home',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'authenticate' => [
                    'name' => 'tssAuthentication/authenticate',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'confirm-email' => [
                    'name' => 'tssAuthentication/confirm-email',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'signin' => [
                    'name' => 'tssAuthentication/signin',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'signout' => [
                    'name' => 'tssAuthentication/signout',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'signup' => [
                    'name' => 'tssAuthentication/signup',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'account' => [
                    'name' => 'tssAuthentication/default',
                    'params' => ['controller' => 'account'],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'password-change' => [
                    'name' => 'tssAuthentication/default',
                    'params' => ['controller' => 'account', 'action' => 'password-change'],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
            ],
            'config' => [
                'identityClass' => Application\Entity\User::class,
                'identityProperty' => 'username',
                'credentialClass' => Application\Entity\Credential::class,
                'credentialProperty' => 'value',
                'credentialIdentityProperty' => 'user',
                'credentialType' => Application\Entity\Credential::TYPE_PASSWORD,
                'credential_callable' => function (Application\Entity\User $user, Application\Entity\Credential $credential) {
                    if ($user->getId() == $credential->getUser()->getId() && $user->isActive()) {
                        return true;
                    } else {
                        return false;
                    }
                },
                'identityEmail' => 'email',
                'identityActive' => false,
                'roleClass' => Application\Entity\Role::class,
                'roleDefault' => 2,
            ],

            'acl' => [
                'use_database_storage' => false,
                'default_role' => 'Guest',
                'roles' => [
                    'Guest' => null,
                    'Member' => ['Guest'],
                    'Admin' => ['Member'],
                ],
                'resources' => [
                    'allow' => [
                        'Application\Controller\Index' => [
                            '' => ['Member']
                        ],
                        'TSS\Authentication\Controller\Account' => [
                            '' => ['Member'],
                        ],
                        'TSS\Authentication\Controller\Auth' => [
                            'authenticate' => ['Guest'],
                            'confirm-email' => ['Guest'],
                            'signin' => ['Guest'],
                            'signout' => ['Guest'],
                            'signup' => ['Guest'],
                        ],
                        'TSS\Authentication\Menu' => [
                            'account' => ['Member']
                        ],
                    ],
                    'deny' => [
                        'TSS\Authentication\Controller\Auth' => [
                            'signup' => ['Member'],
                        ],
                    ]
                ]
            ]

        ]
    ]
];
