<?php

namespace HallsApplication;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'homePage' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/',
                    'constraints' => array(
                        'id' => '\d+',
                    ),
                    'defaults' => [
                        'controller' => Controller\PageController::class,
                        'action'     => 'getHomePage',
                    ],
                ],
            ],
            'hallProfile' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/halls/:id',
                    'constraints' => array(
                        'id' => '\d+',
                    ),
                    'defaults' => [
                        'controller' => Controller\PageController::class,
                        'action'     => 'getHallProfilePage',
                    ],
                ],
            ],
            'addHallReview' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/halls/:id/review',
                    'constraints' => array(
                        'id' => '\d+',
                    ),
                    'defaults' => [
                        'controller' => Controller\PageController::class,
                        'action'     => 'addReviewForHall',
                    ],
                ],
            ],
            'addNewHall' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/add',
                    'defaults' => [
                        'controller' => Controller\PageController::class,
                        'action'     => 'addNewHall',
                    ],
                ],
            ],


            'getHalls' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/api/halls',
                    'defaults' => [
                        'controller' => Controller\HallsController::class,
                        'action'     => 'getHalls',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'specificId' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/:id',
                            'constraints' => array(
                                'id' => '\d+',
                            ),
                            'defaults' => [
                                'action'     => 'getHall',
                            ],
                        ],
                    ]
                ]
            ],
            'getUniversities' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/api/universities[/:id]',
                    'constraints' => array(
                        'id' => '\d+',
                    ),
                    'defaults' => [
                        'controller' => Controller\HallsController::class,
                        'action'     => 'getUniversities',
                    ],
                ],
            ],
            'addReivew' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/api/halls/:id/review',
                    'constraints' => array(
                        'id' => '\d+',
                    ),
                    'defaults' => [
                        'controller' => Controller\HallsController::class,
                        'action'     => 'postReview',
                    ],
                ],
            ]
            
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\PageController::class => Factory\Controller\PageControllerFactory::class,
            Controller\HallsController::class => Factory\Controller\HallsControllerFactory::class
        ],
    ],
    'service_manager' => [
        'factories' => [
            Table\HallsTable::class => Factory\Table\HallsTableFactory::class,
            Table\HallsImageTable::class => Factory\Table\HallsImageTableFactory::class,
            Table\UniversityTable::class => Factory\Table\UniversiryTableFactory::class,
            Table\ReviewTable::class => Factory\Table\ReviewTableFactory::class,
            Service\HallsService::class => Factory\Service\HallsServiceFactory::class,
            Service\UniversityService::class => Factory\Service\UniversityServiceFactory::class,
            Service\ImageService::class => Factory\Service\ImageServiceFactory::class,
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
            'hallProfile' => __DIR__ . '/../view/application/hallProfile.phtml',
            'addReview' => __DIR__ . '/../view/application/addReview.phtml',
            'addHall' => __DIR__ . '/../view/application/addHalls.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ],
];
