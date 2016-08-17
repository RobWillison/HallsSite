<?php

namespace HallsApplication\Factory\Table;

use HallsApplication\Table\ReviewTable;
use Interop\Container\ContainerInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Factory\FactoryInterface;

class ReviewTableFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('Zend\Db\Adapter\Adapter');

        $tableGateway = new TableGateway('review', $adapter);

        $hydrator = new ClassMethods();

        $hallsTable = new ReviewTable($tableGateway, $hydrator);

        return $hallsTable;
    }
}