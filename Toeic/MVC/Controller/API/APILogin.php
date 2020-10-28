<?php
require_once "./MVC/config/api.php";
require_once "./MVC/Controller/Source/JwtHandler.php";
require_once "./MVC/core/controllers.php";
require_once "./MVC/lib/vendor/autoload.php";

class APILogin extends Controller
{
    var $google_client;

    public function __construct(){
        parent::__construct();
        $this->google_client = new Google_Client();
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
        $this->google_client->setClientId('396392212728-cge5bljei18i20n57d0gpqva0vsbg863.apps.googleusercontent.com');
        $this->google_client->setClientSecret('S6YvlSZ7-B2JnyqY1IwlWCkr');
        $this->google_client->setRedirectUri('http://localhost:85/Toeic/API/APILogin/urlGoogle');
//        $this->google_client->addScope('https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email');
        $this->google_client->addScope("email");
        $this->google_client->addScope("profile");
        if (isset($_GET['code'])){
            $token = $this->google_client->fetchAccessTokenWithAuthCode($_GET['code']);
            if (isset($token['access_token'])){
                $this->google_client->setAccessToken($token['access_token']);
                $oAuth = new Google_Service_Oauth2($this->google_client);
                $oAuth_info = $oAuth->userinfo->get();
                var_dump($oAuth_info);
            }
        }else{
            $url =  $this->google_client->createAuthUrl();
            echo json_encode(array('google' =>$url));
        }
    }

//    public function infoUserGoogle(){
//        print_r($_GET);
//        print_r($_GET['code']);
//        if (isset($_GET['code'])){
//            $token = $this->google_client->fetchAccessTokenWithAuthCode($_GET['code']);
//            print_r($token);
////            $this->google_client->setAccessToken($);
////            $oAuth = new Google_Service_Oauth2($this->google_client);
////            $google_acc_info = $oAuth->userinfo->get();
////            echo $google_acc_info->email;
//        }
//    }



}