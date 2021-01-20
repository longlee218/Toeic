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

    public function homePage(){
        $this->checkAuth('home/home.php');
    }

    public function registerPage(){
        $this->requireView('auth/register_page.php');
    }
    public function notFound(){
        $this->requireView('404.php');
    }

    public function registerPageEmail(){
        $this->requireView('auth/register_page_email.php');
    }
}