<?php
require_once __DIR__."/../../core/controllers.php";
require_once "./MVC/Middlewares/Auth.php";

class Home extends Controller
{
    public function loginPage(){
        $this->requireView('auth/login_page.php');
    }

    public function WellCome(){
        print_r($_GET);

    }
}