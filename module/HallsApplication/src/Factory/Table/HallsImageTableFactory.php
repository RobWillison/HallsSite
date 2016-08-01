<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/1/16
 * Time: 9:26 PM
 */

namespace HallsApplication\Factory\Table;


use HallsApplication\Table\HallsImageTable;
use Interop\Container\ContainerInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\Factory\FactoryInterface;

class HallsImageTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('Zend\Db\Adapter\Adapter');

        $tableGateway = new TableGateway('hall_images', $adapter);

        $hallsTable = new HallsImageTable($tableGateway);

        return $hallsTable;
    }
}