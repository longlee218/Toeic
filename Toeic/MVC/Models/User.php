<?php
require_once __DIR__.'/../lib/database.php';


class User extends Database
{
    private $model = 'users';

    public function defaultName(){
        echo 'users';
    }

}