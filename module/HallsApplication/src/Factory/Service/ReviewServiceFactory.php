<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/19/16
 * Time: 3:27 PM
 */

namespace HallsApplication\Factory\Service;


use HallsApplication\Service\ReviewService;
use HallsApplication\Table\ReviewTable;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ReviewServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hydrator = new ClassMethods();
        $reviewTable = $container->get(ReviewTable::class);
        
        return new ReviewService($reviewTable, $hydrator);
    }
}