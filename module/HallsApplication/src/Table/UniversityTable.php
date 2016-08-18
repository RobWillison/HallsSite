<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/1/16
 * Time: 9:40 PM
 */

namespace HallsApplication\Table;


use HallsApplication\Entity\UniversityEntity;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\ClassMethods;

class UniversityTable
{
    protected $tableGateway;
    protected $hydrator;

    public function __construct(TableGateway $tableGateway, ClassMethods $hydrator)
    {
        $this->tableGateway = $tableGateway;
        $this->hydrator = $hydrator;
    }

    public function fetchAll()
    {
        $select = new Select();
        $select->from('universities');
        $select->order('name ASC');

        $resultSet = $this->tableGateway->selectWith($select);

        $data = [];

        while ($resultSet->valid()) {

            $currentArray = $resultSet->current();

            $data[] = $this->hydrator->hydrate($currentArray->getArrayCopy(), new UniversityEntity());

            $resultSet->next();
        }

        return $data;
    }

    public function fetch($id)
    {
        $where = new Where();
        $where->equalTo('id', $id);

        $resultSet = $this->tableGateway->select($where);

        $currentArray = $resultSet->current()->getArrayCopy();

        return $this->hydrator->hydrate($currentArray, new UniversityEntity());
    }
}