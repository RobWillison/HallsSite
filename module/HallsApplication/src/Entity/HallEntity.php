<?php

namespace HallsApplication\Entity;

class HallEntity
{
    private $id;
    private $hallName;
    private $universityId;
    private $longitude;
    private $latitude;
    private $images;
    private $university;

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

    public function getHallName()
    {
        return $this->hallName;
    }

    public function setHallName($hallName)
    {
        $this->hallName = $hallName;
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