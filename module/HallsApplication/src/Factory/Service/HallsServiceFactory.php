<?php

namespace HallsApplication\Factory\Service;

use HallsApplication\Hydrator\HallHydrator;
use HallsApplication\Service\ElasticSearchService;
use HallsApplication\Service\HallsService;
use HallsApplication\Service\ImageService;
use HallsApplication\Service\ReviewService;
use HallsApplication\Table\HallsImageTable;
use HallsApplication\Table\HallsTable;
use HallsApplication\Table\ReviewTable;
use HallsApplication\Table\UniversityTable;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\ClassMethods;
use Zend\ServiceManager\Factory\FactoryInterface;

class HallsServiceFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $hallTable = $container->get(HallsTable::class);
        $hallImageTable = $container->get(HallsImageTable::class);
        $universityTable = $container->get(UniversityTable::class);
        $reviewService = $container->get(ReviewService::class);
        $hydrator = new HallHydrator();
        $imageService = $container->get(ImageService::class);
        $searchService = $container->get(ElasticSearchService::class);

        return new HallsService($hallTable, $hallImageTable, $universityTable, $reviewService, $hydrator, $imageService, $searchService);
    }
}