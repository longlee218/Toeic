<?php
require_once __DIR__.'/../lib/database.php';


class User extends Database
{
    private $model = 'users';

    public function defaultName(){
        echo 'users';
    }

    public function selectUser($name){
        $query = "select * from users where username=? or email=?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ss", $name, $name);
        $stmt->execute();
        return $stmt->get_result();

    }
    public function selectAllByID($id){
        $fetch_user_by_id = "SELECT id, username, first_name, last_name,
                               email, gender, user_type, country, school_name,
                               class_name, organization_name, organization_type, 
                               `position`, city, date_join FROM users WHERE id=?";
        $this->con->init();
        $stmt = $this->con->prepare($fetch_user_by_id);
        $stmt->bind_param("d", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function selectAllByGoogleID($google_id){
        $fetch_user_by_id = "SELECT id, username, first_name, last_name,
                               email, gender, user_type, country, school_name,
                               class_name, organization_name, organization_type, 
                               `position`, city, date_join FROM users WHERE google_id like ?";
        $this->con->init();
        $stmt = $this->con->prepare($fetch_user_by_id);
        $stmt->bind_param("s", $google_id);
        $stmt->execute();
        return $stmt->get_result();
    }

}