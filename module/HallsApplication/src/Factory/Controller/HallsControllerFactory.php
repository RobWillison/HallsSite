<?php

namespace HallsApplication\Factory\Controller;

use HallsApplication\Controller\HallsController;
use HallsApplication\Service\HallsService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class HallsControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hallsService = $container->get(HallsService::class);

        $controller = new HallsController($hallsService);

        return $controller;
    }
}