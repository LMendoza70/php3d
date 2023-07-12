<?php
class DefaultController
{
    private $vista;

    public function index()
    {
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            $vista = "app/view/admin/home.php";
            include_once("app/view/admin/PlantillaView.php");
        } else {
            $vista = "app/view/admin/home.php";
            include_once("app/view/admin/Plantilla2View.php");
        }
    }

    /* public function register(){
            $vista="app/view/UserAddView.php";
            //antes de llmar a la plantilla podemos invocar a los modelos y trabajar 
            //el resultado de estos 
            include_once("app/view/PlantillaView.php");
        }*/
}
