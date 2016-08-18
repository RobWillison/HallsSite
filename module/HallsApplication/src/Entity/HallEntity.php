<?php

namespace HallsApplication\Entity;

class HallEntity
{
    private $id;
    private $name;
    private $universityId;
    private $longitude;
    private $latitude;
    private $university;
    private $addressFirstLine;
    private $addressSecondLine;
    private $addressCity;
    private $addressPostcode;

    private $ratings;

    private $images;
    private $reviews;

    /**
     * @return mixed
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @param mixed $ratings
     */
    public function setRatings($ratings)
    {
        $this->ratings = $ratings;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @return mixed
     */
    public function getAddressFirstLine()
    {
        return $this->addressFirstLine;
    }

    /**
     * @param mixed $addressFirstLine
     */
    public function setAddressFirstLine($addressFirstLine)
    {
        $this->addressFirstLine = $addressFirstLine;
    }

    /**
     * @return mixed
     */
    public function getAddressSecondLine()
    {
        return $this->addressSecondLine;
    }

    /**
     * @param mixed $addressSecondLine
     */
    public function setAddressSecondLine($addressSecondLine)
    {
        $this->addressSecondLine = $addressSecondLine;
    }

    /**
     * @return mixed
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * @param mixed $addressCity
     */
    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;
    }

    /**
     * @return mixed
     */
    public function getAddressPostcode()
    {
        return $this->addressPostcode;
    }

    /**
     * @param mixed $addressPostcode
     */
    public function setAddressPostcode($addressPostcode)
    {
        $this->addressPostcode = $addressPostcode;
    }

    /**
     * @return mixed
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * @param mixed $university
     */
    public function setUniversity($university)
    {
        $this->university = $university;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getUniversityId()
    {
        return $this->universityId;
    }

    public function setUniversityId($universityId)
    {
        $this->universityId = $universityId;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = (float) $longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = (float) $latitude;
    }
}