<?php

namespace HallsApplication\Table;

use HallsApplication\Entity\HallEntity;
use HallsApplication\Hydrator\HallDataHydrator;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\ClassMethods;

class HallsTable {
    protected $tableGateway;
    protected $hydrator;

    public function __construct(TableGateway $tableGateway, ClassMethods $hydrator)
    {
        $this->tableGateway = $tableGateway;
        $this->hydrator = $hydrator;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();

        $data = [];

        while ($resultSet->valid()) {

            $currentArray = $resultSet->current();

            $data[] = $this->hydrator->hydrate($currentArray->getArrayCopy(), new HallEntity());

            $resultSet->next();
        }

        return $data;
    }

    public function fetch($id)
    {
        $where = new Where();
        $where->equalTo('id', $id);

        $resultSet = $this->tableGateway->select($where);

        $currentArray = $resultSet->current();

        return $this->hydrator->hydrate($currentArray->getArrayCopy(), new HallEntity());
    }

    public function insert(HallEntity $hall)
    {
        $array = $this->hydrator->extract($hall);

        $columns = ['id', 'name', 'university_id', 'longitude', 'latitude', 'address_first_line', 'address_second_line', 'address_city', 'address_postcode'];

        foreach ($array as $itemName => $item) {
            if (array_search($itemName, $columns) === false) {
                unset($array[$itemName]);
            }
        }

        $this->tableGateway->insert($array);
    }
}

