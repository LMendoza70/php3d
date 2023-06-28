<?php
    //incluimos en el documento de usercontroller el archivo de 
    //user model para poder instanciarlo
    include_once("app/model/UserModel.php");
    class UserController{
        //agregamos una instancia de nuestro modelo usuario
        private $usermodel;
        
        public function index(){
            //define la ruta de la pagina a mostrar
            $vista="app/view/UserIndexView.php";
            //inicializamos nuestro modelo para poder instanciarlo
            //$this->usermodel=new UserModel();
            //declaramos la variable datos, en la que almacenaremos lo que nos arroje el metodo
            //getall de el modelo usuarios para posteriormente mostrarlos en una tabla 
            //$datos=$this->usermodel->GetAll();
            //incluimos la plantilla principal para poder invocarla 
            include_once("app/view/PlantillaView.php");

        }

        public function CallFormLogin(){
            $vista="app/view/LoginView.php";
            include_once("app/view/PlantillaView.php");
        }

        public function Login(){
            $vista="app/view/home.php";
            //creamos una instancia del modelo
            $usermodel=new UserModel();

            $usuario=$usermodel->getCredentials($_POST['user'],$_POST['password']);

            if($usuario==false){
                $x="gess";
            }else{
                $x=$usuario['nombre'];
            }

            include_once("app/view/PlantillaView.php");
        }

        //agregamos controladores diversos para invocar otros metodos (agregar usuario, eliminar , editar)
    }
?>