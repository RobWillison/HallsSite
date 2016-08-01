<?php

namespace HallsApplication\Factory\Controller;

use HallsApplication\Controller\IndexController;
use HallsApplication\Service\HallsService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class IndexControllerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hallsTable = $container->get(HallsService::class);

        $controller = new IndexController($hallsTable);

        return $controller;
    }
}