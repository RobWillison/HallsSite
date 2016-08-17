<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/3/16
 * Time: 7:39 PM
 */

namespace HallsApplication\Entity;


class ReviewEntity
{
    private $hallId;
    
    private $reviewText;
    private $ratingLocation;
    private $ratingCommunity;
    private $ratingComfort;
    private $ratingValue;
    private $ratingSocialSpace;
    private $reviewer;

    private $location;

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getHallId()
    {
        return $this->hallId;
    }

    /**
     * @param mixed $hallId
     */
    public function setHallId($hallId)
    {
        $this->hallId = $hallId;
    }

    /**
     * @return mixed
     */
    public function getReviewer()
    {
        return $this->reviewer;
    }

    /**
     * @param mixed $reviewer
     */
    public function setReviewer($reviewer)
    {
        $this->reviewer = $reviewer;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getReviewText()
    {
        return $this->reviewText;
    }

    /**
     * @param mixed $reviewText
     */
    public function setReviewText($reviewText)
    {
        $this->reviewText = $reviewText;
    }

    /**
     * @return mixed
     */
    public function getRatingLocation()
    {
        return $this->ratingLocation;
    }

    /**
     * @param mixed $ratingLocation
     */
    public function setRatingLocation($ratingLocation)
    {
        $this->ratingLocation = $ratingLocation;
    }

    /**
     * @return mixed
     */
    public function getRatingCommunity()
    {
        return $this->ratingCommunity;
    }

    /**
     * @param mixed $ratingCommunity
     */
    public function setRatingCommunity($ratingCommunity)
    {
        $this->ratingCommunity = $ratingCommunity;
    }

    /**
     * @return mixed
     */
    public function getRatingComfort()
    {
        return $this->ratingComfort;
    }

    /**
     * @param mixed $ratingConfort
     */
    public function setRatingComfort($ratingComfort)
    {
        $this->ratingComfort = $ratingComfort;
    }

    /**
     * @return mixed
     */
    public function getRatingValue()
    {
        return $this->ratingValue;
    }

    /**
     * @param mixed $ratingValue
     */
    public function setRatingValue($ratingValue)
    {
        $this->ratingValue = $ratingValue;
    }

    /**
     * @return mixed
     */
    public function getRatingSocialSpace()
    {
        return $this->ratingSocialSpace;
    }

    /**
     * @param mixed $ratingSocialSpace
     */
    public function setRatingSocialSpace($ratingSocialSpace)
    {
        $this->ratingSocialSpace = $ratingSocialSpace;
    }
}