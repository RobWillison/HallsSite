<?php

namespace HallsApplication\Service;

use HallsApplication\Entity\ReviewEntity;
use HallsApplication\Table\HallsImageTable;
use HallsApplication\Table\HallsTable;
use HallsApplication\Table\ReviewTable;
use HallsApplication\Table\UniversityTable;
use Zend\Hydrator\HydratorInterface;

class HallsService
{
    private $hallTable;
    private $hallImageTable;
    private $universityTable;
    private $reviewTable;
    private $hydrator;
    

    public function __construct(
        HallsTable $hallTable,
        HallsImageTable $hallImageTable,
        UniversityTable $universityTable,
        ReviewTable $reviewTable,
        HydratorInterface $hydrator
    ){
        $this->hallTable = $hallTable;
        $this->hallImageTable = $hallImageTable;
        $this->universityTable = $universityTable;
        $this->reviewTable = $reviewTable;
        $this->hydrator = $hydrator;
        
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
        $reviews = $this->reviewTable->fetch($id);
        $totalRating = $this->reviewTable->fetchTotal($id);

        $hallEntity = $this->hallTable->fetch($id);
        $hallEntity->setImages($images);
        $hallEntity->setReviews($reviews);
        $hallEntity->setRatings($totalRating);

        $universityEntity = $this->universityTable->fetch($hallEntity->getUniversityId());

        $hallEntity->setUniversity($universityEntity);
        
        return $this->hydrator->extract($hallEntity);
    }

    public function addReview($hallId, $reviewArray) {
        
        $review = $this->hydrator->hydrate($reviewArray, new ReviewEntity());
        $review->setHallId($hallId);
        
        $result = $this->reviewTable->insert($review);

        return $result;
    }
}