<?php

class Package extends ActiveRecord\Model {

    static $validates_uniqueness_of = array(
        array(
            array('name', 'url'),
            'message' => 'must be unique'
        )
    );

    static $validates_presence_of = array(
        array('name', 'allow_null' => FALSE, 'allow_blank' => FALSE, 'message' => 'is required', 'on' => 'create'),
        array('url', 'allow_null' => FALSE, 'allow_blank' => FALSE, 'message' => 'is required', 'on' => 'create')        
    );

    static $validates_format_of = array(
        array('url', 'with' => '/^git\:\/\//', 'message' => 'must be a valid git:// url' , 'on' => 'create')
    );

}

?>