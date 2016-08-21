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
                    'defaults' => [
                        'controller' => Controller\PageController::class,
                        'action'     => 'getHomePage',
                    ],
                ],
            ],
            'mapPage' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/map',
                    'defaults' => [
                        'controller' => Controller\PageController::class,
                        'action'     => 'getMapPage',
                    ],
                ],
            ],
            'hallProfile' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/halls/:id',
                    'constraints' => array(
                        'id' => '[a-zA-Z0-9-]*',
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
                        'id' => '[a-zA-Z0-9-]*',
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
            'contact' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/contact',
                    'defaults' => [
                        'controller' => Controller\PageController::class,
                        'action'     => 'contactPage',
                    ],
                ],
            ],

            'searchHalls' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/api/search/halls',
                    'defaults' => [
                        'controller' => Controller\HallsController::class,
                        'action'     => 'searchHalls',
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
                                'id' => '[a-zA-Z0-9-]*',
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
                        'id' => '[a-zA-Z0-9-]*',
                    ),
                    'defaults' => [
                        'controller' => Controller\HallsController::class,
                        'action'     => 'postReview',
                    ],
                ],
            ],
            'addHalls' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/api/add',
                    'defaults' => [
                        'controller' => Controller\HallsController::class,
                        'action'     => 'addHalls',
                    ],
                ],
            ],
            'addHalls' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/api/contact',
                    'defaults' => [
                        'controller' => Controller\HallsController::class,
                        'action'     => 'contact',
                    ],
                ],
            ],
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
            Service\ElasticSearchService::class => Factory\Service\ElasticSearchServiceFactory::class,
            Service\ReviewService::class => Factory\Service\ReviewServiceFactory::class,
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
            'map' => __DIR__ . '/../view/application/mapPage.phtml',
            'home' => __DIR__ . '/../view/application/homePage.phtml',
            'hallProfile' => __DIR__ . '/../view/application/hallProfile.phtml',
            'addReview' => __DIR__ . '/../view/application/addReview.phtml',
            'addHall' => __DIR__ . '/../view/application/addHalls.phtml',
            'contact' => __DIR__ . '/../view/application/contact.phtml',
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
