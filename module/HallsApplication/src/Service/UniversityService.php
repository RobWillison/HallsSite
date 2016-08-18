<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/4/16
 * Time: 11:08 AM
 */

namespace HallsApplication\Service;


use HallsApplication\Table\UniversityTable;
use Zend\Hydrator\HydratorInterface;

class UniversityService
{
    private $universityTable;
    private $hydrator;

    public function __construct(
        UniversityTable $universityTable,
        HydratorInterface $hydrator
    )
    {
        $this->universityTable = $universityTable;
        $this->hydrator = $hydrator;
    }
    
    public function getList() {
        $unis = $this->universityTable->fetchAll();

        $listOfUnis = [];

        foreach ($unis as $uni) {
            $listOfUnis[] = $this->hydrator->extract($uni);
        }

        return $listOfUnis;
    }
}