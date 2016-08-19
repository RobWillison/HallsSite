<?php

namespace HallsApplication\Factory\Service;

use HallsApplication\Hydrator\HallHydrator;
use HallsApplication\Service\ElasticSearchService;
use HallsApplication\Service\HallsService;
use HallsApplication\Service\ImageService;
use HallsApplication\Table\HallsImageTable;
use HallsApplication\Table\HallsTable;
use HallsApplication\Table\ReviewTable;
use HallsApplication\Table\UniversityTable;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Factory\FactoryInterface;

class ElasticSearchServiceFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ElasticSearchService();
    }
}