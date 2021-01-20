<?php

require_once "./MVC/config/api.php";
require_once "./MVC/Controller/Source/JwtHandler.php";
require_once "./MVC/core/controllers.php";
require_once "./MVC/lib/vendor/autoload.php";
class APILogin extends Controller
{
    var $user_model;

    public function __construct(){
        parent::__construct();
        $this->user_model  = $this->requireModel('User');
    }

    private function messages_token($success, $status, $mess, $token=null, $url=null, $expire=null){
        return array(
            "success"=>$success,
            "status"=>$status,
            "mess"=>$mess,
            "token"=>$token,
            "exp"=>$expire,
            "url"=>$url
        );
    }

    public function urlGoogle(){
        $google_client = new Google_Client();
        $google_client->setClientId(GOOGLE_ACCESS['client_id']);
        $google_client->setClientSecret(GOOGLE_ACCESS['client_secret']);
        $google_client->setRedirectUri(GOOGLE_ACCESS['redirect_url']);
        $google_client->addScope("email");
        $google_client->addScope("profile");
        if (isset($_GET['code'])){
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
            if (isset($token['access_token'])){
                $google_client->setAccessToken($token);
                $oAuth = new Google_Service_Oauth2($google_client);
                $oAuth_info = $oAuth->userinfo->get();
                $user_model = $this->requireModel('User');
                try {
                    $user = $user_model->selectAllByGoogleID($oAuth_info['id']);
                    if ($user->num_rows){
                        $this->sessionLogin($user);
                        $jwt_handler = new JwtHandler();
                        $data_json = ['id' => $_SESSION['id'], 'role'=>1];
                        $token_return = $jwt_handler->_jwt_encode_token("", $data_json);
                        setcookie('Authorization', $token_return, time()+TIME_LIFE_COOKIE, '/');
                        header('Location: /../Toeic/home');
                        die();
                    }else{
                        //truong hop register user
                       $_SESSION['google_user'] = $oAuth_info;
                       header('Location: /../Toeic/register/email');
                       die();
                    }
                }catch(Exception $e){
                    echo json_encode(['google' => 'something wrong']);
                }
            }
        }else{
            $url =  $google_client->createAuthUrl();
            echo json_encode(array('google' =>$url));
        }
    }
    public function loginBasic(){
//        $this->data =json_decode(file_get_contents('php://input'));
        if(!$this->isPost()){
            $returnData = $this->messages_token(false, 405, "Method is not allow");
        } else if (!isset($this->data->email)||!isset($this->data->password)
            ||empty(trim($this->data->email))||empty(trim($this->data->password))){
            $returnData = $this->messages_token(false, 400, "Please fill in this fields");
        } else{
            $email = $this->data->email;
            $password = $this->data->password;
            $user =  $this->user_model->selectUser($email);
            if ($user->num_rows){
                $row = $user->fetch_assoc();
                if (md5($password) == $row['password']){
                    $jwt_handler = new JwtHandler();
                    if ($row['user_type'] == 1){
                        $data_json = ['id' => $row['id'], 'role'=>1];
                        $token_return = $jwt_handler->_jwt_encode_token("", $data_json);

                    }else if ($row['user_type'] == 2){
                        $data_json = ['id' => $row['id'], 'role'=>2];
                        $token_return = $jwt_handler->_jwt_encode_token("", $data_json);
                    }
                    setcookie('Authorization', $token_return, time()+TIME_LIFE_COOKIE, '/');
                    setcookie('username', $email, time()+TIME_LIFE_COOKIE, '/');
                    if ($this->data->save){
                        setcookie('password', $password, time()+TIME_LIFE_COOKIE, '/');
                    }else{
                        setcookie('password','', time()-1000, '/');
                    }
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['auth'] = $row;
                    $_SESSION['success'] = 'You are login';
                    $returnData = $this->messages_token(true, 200, 'You are login', $token_return);
                }else{
                    $returnData = $this->messages_token(false, 400, 'Wrong password');
                }
            }else{
                $returnData = $this->messages_token(false, 400, 'Wrong email or username');
            }
        }
        echo json_encode($returnData);
    }

    private function sessionLogin($user){
        try{
            $row = $user->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['auth'] = $row;
            $_SESSION['success'] = 'You are login';
        }catch(Exception $e){
            session_destroy();
        }
    }

    private function cookieLogin(){

    }

    private function checkAuthUser(){

    }

    public function logout(){
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            if ($name == 'username' || $name == 'password'){
                continue;
            }
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
        session_destroy();
        header('Location: /../Toeic/login-page');
        die();
    }
}