<?php

namespace HallsApplication\Factory\Service;

use HallsApplication\Hydrator\HallHydrator;
use HallsApplication\Service\HallsService;
use HallsApplication\Table\HallsImageTable;
use HallsApplication\Table\HallsTable;
use HallsApplication\Table\ReviewTable;
use HallsApplication\Table\UniversityTable;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Factory\FactoryInterface;

class HallsServiceFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hallTable = $container->get(HallsTable::class);
        $hallImageTable = $container->get(HallsImageTable::class);
        $universityTable = $container->get(UniversityTable::class);
        $reviewTable = $container->get(ReviewTable::class);
        $hydrator = new HallHydrator();

        return new HallsService($hallTable, $hallImageTable, $universityTable, $reviewTable, $hydrator);
    }
}