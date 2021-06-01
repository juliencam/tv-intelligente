<?php
namespace App;

class ObjectHelpers {

    public static function hydrate ($object, array $data, array $field)
    {
        
        foreach($field as $partOfMethod ){
            $callMethod = 'set'. ucwords($partOfMethod);
            $object->$callMethod($data[$partOfMethod]);
            
        }

    }

}