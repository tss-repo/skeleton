<?php

return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => _('Home'),
                'route' => 'home',
                'resource' => 'Application\Controller\Index',
                'privilege' => 'index',
            ),
            array(
                'label' => '<span class="fa fa-user fa-lg"></span> <b class="caret"></b>',
                'uri' => ' ',
                'attribs' => array('data-toggle' => 'dropdown'),
                'wrapClass' => 'dropdown',
                'class' => 'dropdown-toggle',
                'ulClass' => 'dropdown-menu',
                'resource' => 'TSS\Authentication\Menu',
                'privilege' => 'account',
                'pages' => array(
                    array(
                        'label' => _('<i class="fa fa-user fa-fw"></i> Profile'),
                        'route' => 'tssAuthentication/default',
                        'controller' => 'account',
                        'resource' => 'TSS\Authentication\Controller\Account',
                        'privilege' => 'index',
                    ),
                    array(
                        'label' => _('<i class="fa fa-sign-out fa-fw"></i> Sign out'),
                        'route' => 'tssAuthentication/signout',
                        'resource' => 'TSS\Authentication\Controller\Auth',
                        'privilege' => 'signout',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
);
