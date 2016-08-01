<?php

namespace HallsApplication;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'hallsPage' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/halls/:id',
                    'constraints' => array(
                        'id' => '\d+',
                    ),
                    'defaults' => [
                        'controller' => Controller\HallsController::class,
                        'action'     => 'getHall',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Factory\Controller\IndexControllerFactory::class,
            Controller\HallsController::class => Factory\Controller\HallsControllerFactory::class
        ],
    ],
    'service_manager' => [
        'factories' => [
            Table\HallsTable::class => Factory\Table\HallsTableFactory::class,
            Table\HallsImageTable::class => Factory\Table\HallsImageTableFactory::class,
            Table\UniversityTable::class => Factory\Table\UniversiryTableFactory::class,
            Service\HallsService::class => Factory\Service\HallsServiceFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'index' => __DIR__ . '/../view/application/index.phtml',
            'hallsProfile' => __DIR__ . '/../view/application/hallsProfile.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
