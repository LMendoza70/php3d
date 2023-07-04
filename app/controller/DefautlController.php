<?php
    class DefaultController{
        private $vista;
        
        public function index(){
            $vista="app/view/admin/home.php";
            include_once("app/view/admin/PlantillaView.php");
        }

       /* public function register(){
            $vista="app/view/UserAddView.php";
            //antes de llmar a la plantilla podemos invocar a los modelos y trabajar 
            //el resultado de estos 
            include_once("app/view/PlantillaView.php");
        }*/
    }
?>