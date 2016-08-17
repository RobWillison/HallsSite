<?php

namespace HallsApplication\Hydrator;

use Zend\Db\ResultSet\ResultSet;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\HydratorInterface;

class HallHydrator implements HydratorInterface{

    public function extract($object)
    {
        $methods = get_class_methods($object);

        $array = [];
        
        foreach ($methods as $method) {
            if (strpos($method, 'get') === 0) {
                $element = $this->CamelCaseToSnake(substr($method, 3));
                $value = $object->$method();
                if(is_object($value)) {
                    $value = $this->extract($value);
                }
                if(is_array($value)) {
                    $value = $this->checkArrayForObjects($value);
                }
                $array[$element] = $value;
            }
        }

        return $array;
    }

    private function checkArrayForObjects($array)
    {
        if(is_array($array)) {
            $checkedArray = [];
            foreach ($array as $key => $element) {
                $checkedArray[$key] = $this->checkArrayForObjects($element);
            }
            return $checkedArray;
        }

        if(is_object($array)) {
            return $this->extract($array);
        }

        return $array;
    }

    private function CamelCaseToSnake($string) {
        $matches = [];
        $string = lcfirst($string);
        preg_match_all('/[A-Z]/', $string, $matches);

        foreach ($matches[0] as $match) {
            $string = str_replace($match, '_' . strtolower($match), $string);
        }

        return $string;
    }

    public function hydrate(array $data, $object)
    {
        $classMethods = new ClassMethods();
        return $classMethods->hydrate($data, $object);
    }
}