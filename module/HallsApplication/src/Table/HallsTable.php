<?php

namespace HallsApplication\Table;

use HallsApplication\Entity\HallEntity;
use HallsApplication\Hydrator\HallDataHydrator;
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
}