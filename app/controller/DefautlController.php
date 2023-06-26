<?php
    class DefaultController{
        private $vista;
        public function index(){
            $vista="app/view/home.php"
            include_once("app/view/PlantillaView.php");
        }
    }
?>