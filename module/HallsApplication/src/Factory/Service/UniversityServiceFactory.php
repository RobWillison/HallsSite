<?php

namespace HallsApplication\Factory\Service;

use HallsApplication\Service\UniversityService;
use HallsApplication\Table\UniversityTable;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Factory\FactoryInterface;

class UniversityServiceFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $universityTable = $container->get(UniversityTable::class);
        $hydrator = new ClassMethods();

        return new UniversityService($universityTable, $hydrator);
    }
}