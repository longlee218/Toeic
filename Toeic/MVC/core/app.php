<?php
class App
{
    private $folder = 'Source';             //Folder Source
    private $controller = 'Login';           //file in .MVC/Source/
    private $action = 'defaultFunction';    //function in .MVC/Source/$controller/
    private $param = [];                    //variable for function
    private $file_path = '';                //file path

    //Determine the url
    public function __construct()
    {
        $arr = $this->urlProcess();
        //Check folder exist
        if (is_dir('./MVC/Controller/'.$arr[0])){
            $this->folder = $arr[0];
        }
        unset($arr[0]);
        if(file_exists("./MVC/Controller/".$this->folder.'/'.$arr[1].".php")){
            $this->controller = $arr[1];
        }
        unset($arr[1]);
        $this->file_path =  "./MVC/Controller/".$this->folder.'/'.$this->controller.".php";
        require_once $this->file_path;

        if( class_exists($this->controller)) {
            $this->controller = new $this->controller;

            if (isset($arr[2])) {
                if (method_exists($this->controller, $arr[2])) {
                    $this->action = $arr[2];
                }
                unset($arr[2]);
            }

            if ($arr) {
                $this->param = $arr;
            }
            call_user_func_array([$this->controller, $this->action], $this->param);
        }
    }

    public function urlProcess()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(trim($_GET['url'], '/')));
        }
        return null;
    }
}
