<?php

namespace HallsApplication\Table;


use HallsApplication\Entity\HallEntity;
use HallsApplication\Entity\ReviewEntity;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\ClassMethods;

class ReviewTable
{
    protected $tableGateway;
    protected $hydrator;

    public function __construct(TableGateway $tableGateway, ClassMethods $hydrator)
    {
        $this->tableGateway = $tableGateway;
        $this->hydrator = $hydrator;
    }

    public function fetch($id)
    {
        $where = new Where();
        $where->equalTo('hall_id', $id);

        $resultSet = $this->tableGateway->select($where);

        $reviews = [];

        while($resultSet->current()) {
            $currentArray = $resultSet->current()->getArrayCopy();

            $reviews[] = $this->hydrator->hydrate($currentArray, new ReviewEntity());

            $resultSet->next();
        }

        return $reviews;
    }

    public function fetchTotal($id)
    {

        $select = new Select();
        $select->columns([
            'totalLocation' => new Expression('AVG(rating_location)'),
            'totalCommunity' => new Expression('AVG(rating_community)'),
            'totalComfort' => new Expression('AVG(rating_comfort)'),
            'totalValue' => new Expression('AVG(rating_value)'),
            'totalSocialSpace' => new Expression('AVG(rating_social_space)'),
        ]);

        $select->from(['review' => 'review']);
        $select->where(['hall_id' => $id]);

        $resultSet = $this->tableGateway->selectWith($select);

        $currentArray = $resultSet->current()->getArrayCopy();

        return $currentArray;
    }
    
    public function insert(ReviewEntity $review) {
        $array = $this->hydrator->extract($review);

        $result = $this->tableGateway->insert($array);

        return $result;

    }
}