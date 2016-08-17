<?php

namespace HallsApplication\Factory\Controller;

use HallsApplication\Controller\HallsController;
use HallsApplication\Service\HallsService;
use HallsApplication\Service\ImageService;
use HallsApplication\Service\UniversityService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;

class HallsControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hallsService = $container->get(HallsService::class);
        $universityService = $container->get(UniversityService::class);

        $imageService = $container->get(ImageService::class);

        $controller = new HallsController($hallsService, $universityService, $imageService);

        return $controller;
    }
}