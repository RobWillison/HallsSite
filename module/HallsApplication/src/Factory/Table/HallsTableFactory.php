<?php

namespace HallsApplication\Factory\Table;

use HallsApplication\Hydrator\HallDataHydrator;
use HallsApplication\Table\HallsTable;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Db\TableGateway\TableGateway;

class HallsTableFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('Zend\Db\Adapter\Adapter');
        
        $tableGateway = new TableGateway('halls', $adapter);
        $hydrator = new ClassMethods();

        $hallsTable = new HallsTable($tableGateway, $hydrator);
        
        return $hallsTable;
    }
}