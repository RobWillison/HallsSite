<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/17/16
 * Time: 1:21 PM
 */

namespace HallsApplication\Factory\Service;


use HallsApplication\Service\ImageService;
use HallsApplication\Table\HallsImageTable;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ImageServiceFactory implements FactoryInterface 
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hallImageTable = $container->get(HallsImageTable::class);
        
        return new ImageService($hallImageTable);
    }
}