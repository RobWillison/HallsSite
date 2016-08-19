<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/19/16
 * Time: 3:24 PM
 */

namespace HallsApplication\Service;


use HallsApplication\Entity\ReviewEntity;
use HallsApplication\Table\ReviewTable;
use Zend\Hydrator\HydratorInterface;

class ReviewService
{
    private $reviewTable;
    private $hydrator;
    
    public function __construct(
        ReviewTable $reviewTable,
        HydratorInterface $hydrator
    )
    {
        $this->reviewTable = $reviewTable;
        $this->hydrator = $hydrator;
    }

    public function addReview($hallId, $reviewArray) {

        $review = $this->hydrator->hydrate($reviewArray, new ReviewEntity());
        $review->setHallId($hallId);

        $result = $this->reviewTable->insert($review);

        return $result;
    }
    
    public function getReviews($hallId)
    {
        return $this->reviewTable->fetch($hallId);
    }

    public function getTotal($hallId)
    {
        return $this->reviewTable->fetchTotal($hallId);
    }
}