<?php

require_once "./MVC/config/api.php";
require_once "./MVC/core/controllers.php";
require_once "./MVC/lib/vendor/autoload.php";
class APIRegister extends Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function register(){
        if (!$this->isPost()){
            $returnData = $this->messages(false,405, 'Method not allowed');
        }else{
            $user_model = $this->requireModel('User');
            $error_arr = [];
            foreach($this->data as $key => $value){
                if (empty($value) || is_null($value)){
                    array_push($error_arr, 'Please fill all this fields');
                    break;
                }
            }
            $_SESSION['error'] = $error_arr;
            $returnData = $this->messages(false, 400, $error_arr);
        }
        echo json_encode($returnData);
    }
}