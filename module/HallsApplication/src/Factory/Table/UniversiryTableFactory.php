<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/1/16
 * Time: 9:41 PM
 */

namespace HallsApplication\Factory\Table;


use HallsApplication\Table\UniversityTable;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class UniversiryTableFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('Zend\Db\Adapter\Adapter');

        $tableGateway = new TableGateway('universities', $adapter);

        $hydrator = new ClassMethods();

        $hallsTable = new UniversityTable($tableGateway, $hydrator);

        return $hallsTable;
    }
}