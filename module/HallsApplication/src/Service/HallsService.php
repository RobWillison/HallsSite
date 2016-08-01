<?php

namespace HallsApplication\Service;

use HallsApplication\Hydrator\HallDataHydrator;
use HallsApplication\Table\HallsImageTable;
use HallsApplication\Table\HallsTable;
use HallsApplication\Table\UniversityTable;

class HallsService
{
    private $hallTable;
    private $hallImageTable;
    private $universityTable;

    public function __construct(HallsTable $hallTable, HallsImageTable $hallImageTable, UniversityTable $universityTable)
    {
        $this->hallTable = $hallTable;
        $this->hallImageTable = $hallImageTable;
        $this->universityTable = $universityTable;
    }

    public function getHallsAsJson()
    {
        $hallArray = $this->hallTable->fetchAll();

        $data = [];
        
        foreach ($hallArray as $hall) {

            $data[] = [
                'halls_name' => $hall->getHallName(),
                'latitude' => $hall->getLatitude(),
                'longitude' => $hall->getLongitude(),
                'content' => '<div><a href="/halls/1">' . $hall->getHallName() . '</a></div>',
            ];
        }

        return json_encode($data);
    }

    public function getHall($id) {
        $images = $this->hallImageTable->fetch($id);

        $hallEntity = $this->hallTable->fetch($id);

        $hallEntity->setImages($images);

        $university = $this->universityTable->fetch($hallEntity->getUniversityId());

        $hallEntity->setUniversity($university);
        
        return $hallEntity;
    }
}