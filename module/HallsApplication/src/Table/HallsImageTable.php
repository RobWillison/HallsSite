<?php

namespace HallsApplication\Table;


use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;

class HallsImageTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetch($id)
    {
        $where = new Where();
        $where->equalTo('hallId', $id);

        $resultSet = $this->tableGateway->select($where);

        $images = [];

        while ($resultSet->valid()) {

            $row = $resultSet->current()->getArrayCopy();
            $images[] = $row['imagePath'];

            $resultSet->next();
        }

        return $images;
    }
}