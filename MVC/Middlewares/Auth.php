<?php
require __DIR__."/../Controller/Source/JwtHandler.php";
require_once __DIR__."/../core/controllers.php";
require_once __DIR__.'/../Models/User.php';

class Auth extends JwtHandler {
    protected $db;
    protected $headers;
    protected $token;
    public function __construct($headers) {
        parent::__construct();
        $this->db = new User();
        $this->headers = $headers;
    }

    private function messages($success, $status, $user){
        return array(
            "success"=>$success,
            "status"=>$status,
            "user"=>$user
        );
    }

    public function isAuth(int $position=0){
        if(array_key_exists('Authorization',$this->headers) && !empty(trim($this->headers['Authorization'])) && !empty($_SESSION['id'])):
            $this->token = explode(" ", trim($this->headers['Authorization']));
            if(isset($this->token[$position]) && !empty(trim($this->token[$position]))):
                $data = $this->_jwt_decode_token($this->token[$position]);
                $object = $data['data'];
                if(isset($data['auth']) && isset($object->data) && $data['auth'] && $_SESSION['id'] == $object->data->id):
                    return $this->fetchUser($object->data->id);
                else:
                    return null;
                endif;
            else:
                return null;
            endif;
        else:
            return null;
        endif;
    }

    protected function fetchUserGoogleID($google_id){
        try{
            $result = $this->db->selectAllByGoogleID($google_id);
            if($result->num_rows):
                $row = $result->fetch_assoc();
                return $this->messages(true, 200, $row);
            else:
                return null;
            endif;
        }
        catch(PDOException $e){
            return null;
        }
    }
    protected function fetchUser($user_id){
        try{
            $result = $this->db->selectAllByID($user_id);
            if($result->num_rows):
                $row = $result->fetch_assoc();
                return $this->messages(true, 200, $row);
            else:
                return null;
            endif;
        }
        catch(PDOException $e){
            return null;
        }
    }
}
