<?php

/**
 * Class DB_Controller
 * can be used to store static functions to work with db. Not recommended to write here functions, which could be written inside the models.
 */
class DB_Controller extends Base_Controller
{
    public static function setup()
    {
        $db = [];
        if(!R::testConnection()) {
			$db['host'] = "localhost";				//DEFINE DATABASE HOST
            $db['name'] = "testdb2";                //DEFINE DATABASE
            $db['user'] = "root";                   //DEFINE DATABASE USER
            $db['password'] = "";                   //DEFINE DATABASE USER PASSWORD
            R::setup('mysql:host=' . $db['host'] . ';dbname=' . $db['name'], $db['user'], $db['password']);
        }
    }
}