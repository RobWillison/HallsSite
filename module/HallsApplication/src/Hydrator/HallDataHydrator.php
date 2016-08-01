<?php

namespace HallsApplication\Hydrator;

use Zend\Db\ResultSet\ResultSet;
use Zend\Hydrator\HydratorInterface;

class HallDataHydrator implements HydratorInterface{

    public function extract($object)
    {
        if (!$object instanceof ResultSet) {
            throw new \Exception('Type must be ResultSet');
        }

        return $object->toArray();
    }

    public function hydrate(array $data, $object)
    {
        // TODO: Implement hydrate() method.
    }
}