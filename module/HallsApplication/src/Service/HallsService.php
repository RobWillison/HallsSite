<?php

namespace HallsApplication\Service;

use HallsApplication\Entity\HallEntity;
use HallsApplication\Entity\ReviewEntity;
use HallsApplication\Table\HallsImageTable;
use HallsApplication\Table\HallsTable;
use HallsApplication\Table\ReviewTable;
use HallsApplication\Table\UniversityTable;
use Ramsey\Uuid\Uuid;
use Zend\Hydrator\HydratorInterface;

class HallsService
{
    private $hallTable;
    private $hallImageTable;
    private $universityTable;
    private $reviewService;
    private $hydrator;
    private $imageService;
    private $searchService;
    

    public function __construct(
        HallsTable $hallTable,
        HallsImageTable $hallImageTable,
        UniversityTable $universityTable,
        ReviewService $reviewService,
        HydratorInterface $hydrator,
        ImageService $imageService,
        ElasticSearchService $searchService
    ){
        $this->hallTable = $hallTable;
        $this->hallImageTable = $hallImageTable;
        $this->universityTable = $universityTable;
        $this->reviewService = $reviewService;
        $this->hydrator = $hydrator;
        $this->imageService = $imageService;
        $this->searchService = $searchService;
        
    }

    public function getAll()
    {
        $hallArray = $this->hallTable->fetchAll();

        $data = [];
        
        foreach ($hallArray as $hall) {
            $data[] = $this->hydrator->extract($hall);
        }

        return $data;
    }

    public function getHall($id) {
        $images = $this->hallImageTable->fetch($id);
        $reviews = $this->reviewService->getReviews($id);
        $totalRating = $this->reviewService->getTotal($id);

        $hallEntity = $this->hallTable->fetch($id);
        $hallEntity->setImages($images);
        $hallEntity->setReviews($reviews);
        $hallEntity->setRatings($totalRating);

        $universityEntity = $this->universityTable->fetch($hallEntity->getUniversityId());

        $hallEntity->setUniversity($universityEntity);
        
        return $this->hydrator->extract($hallEntity);
    }
    
    public function addHall(array $hallArray) {
        $id = Uuid::uuid1();
        
        if (array_key_exists('uploadedImages', $hallArray)) {
            foreach ($hallArray['uploadedImages'] as $image) {
                $imageNames[] = $this->imageService->saveBase64Image($id, $image);
            }
            unset($hallArray['uploadedImages']);
        }

        $hall = $this->hydrator->hydrate($hallArray, new HallEntity());
        $hall->setId($id);

        $this->hallTable->insert($hall);
        
        return $id;
    }
    
    public function search($searchTerm)
    {
        $result = $this->searchService->search($searchTerm);

        $numOfResults = $result['hits']['total'];

        if ($numOfResults === 0) {
            return [];
        }

        $hits = [];
        foreach ($result['hits']['hits'] as $hit) {
            $hits[] = $hit['_source'];
        }

        return $hits;

    }
}