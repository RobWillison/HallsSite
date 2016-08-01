<?php

namespace HallsApplication\Factory\Service;

use HallsApplication\Hydrator\HallDataHydrator;
use HallsApplication\Service\HallsService;
use HallsApplication\Table\HallsImageTable;
use HallsApplication\Table\HallsTable;
use HallsApplication\Table\UniversityTable;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class HallsServiceFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hallTable = $container->get(HallsTable::class);
        $hallImageTable = $container->get(HallsImageTable::class);
        $universityTable = $container->get(UniversityTable::class);

        return new HallsService($hallTable, $hallImageTable, $universityTable);
    }
}