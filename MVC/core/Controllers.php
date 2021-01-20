<?php
require_once __DIR__.'/../Middlewares/Auth.php';

class Controller {
    public $model_path = '';
    public $view_path = '';
    protected $auth;
    private  $VIEW = 0;
    protected $data;

    function __construct(){
        $this->data = json_decode(file_get_contents('php://input'));
    }

    protected function messages($success, $status, $mess, $data=null ,$url=null){
        return array(
            "success"=>$success,
            "status"=>$status,
            "mess"=>$mess,
            "data"=>$data,
            "url"=>$url
        );
    }

    protected function requireModel($model){
        $this->model_path =  __DIR__.'/../Models/'.$model.'.php';
        require_once $this->model_path;
        return new $model();
    }

    protected function requireView($view, $data=[]){
        $this->view_path =  "./MVC/Views/".$view;
        require_once $this->view_path;
    }

    protected function isPost() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function isGet() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function checkAuth($view) {
        $this->auth = new Auth($_COOKIE);
        if ($this->auth->isAuth($this->VIEW) != null){
            $this->requireView($view);
        }else{
            require_once __DIR__.'/../Controller/API/APILogin.php';
            $one = new APILogin();
            $one->logout();
        }
    }
}