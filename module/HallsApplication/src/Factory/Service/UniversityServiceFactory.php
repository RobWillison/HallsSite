<?php

namespace HallsApplication\Factory\Service;

use HallsApplication\Service\UniversityService;
use HallsApplication\Table\UniversityTable;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UniversityServiceFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $universityTable = $container->get(UniversityTable::class);

        return new UniversityService($universityTable);
    }
}