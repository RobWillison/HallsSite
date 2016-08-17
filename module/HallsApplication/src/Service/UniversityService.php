<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/4/16
 * Time: 11:08 AM
 */

namespace HallsApplication\Service;


use HallsApplication\Table\UniversityTable;

class UniversityService
{
    private $universityTable;

    public function __construct(UniversityTable $universityTable)
    {
        $this->universityTable = $universityTable;
    }

    public function getAllUniversities() {
        $universityEntities = $this->universityTable->fetchAll();

        return $universityEntities;
    }
    
    public function getList() {
        $unis = $this->universityTable->fetchAll();

        $listOfUnis = [];

        foreach ($unis as $uni) {
            $listOfUnis[] = ['id' => $uni->getId(), 'text' => $uni->getName()];
        }

        return $listOfUnis;
    }
}