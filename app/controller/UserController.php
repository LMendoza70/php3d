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
            $this->usermodel=new UserModel();
            //declaramos la variable datos, en la que almacenaremos lo que nos arroje el metodo
            //getall de el modelo usuarios para posteriormente mostrarlos en una tabla 
            $datos=$this->usermodel->GetAll();
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
    

        //agregamos una funcion para llamar al formulario de agregar usuario
        public function CallFormAdd(){
            $vista="app/view/UserAddView.php";
            include_once("app/view/PlantillaView.php");
        }

        //agregamos la funcion para agregar un usuario
        public function Add(){
            //verificamos que haya llegado a este metodo desde post
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //creamos un arreglo para almacenar los datos del formulario y asi llamar 
                //al metodo adduser del modelo y pasarle los datos del formulario
                $user=array(
                    'Usuario'=>$_POST['user'],
                    'Password'=>$_POST['password'],
                    'Nombre'=>$_POST['nombre'],
                    'ApPaterno'=>$_POST['apate'],
                    'ApMaterno'=>$_POST['amate'],
                    'Sexo'=>$_POST['sex'],
                    'FchNacimiento'=>$_POST['fchnac'],
                );                
            //creamos una instancia del modelo
            $usermodel=new UserModel();
            //llamamos al metodo adduser del modelo y le pasamos los datos del formulario mediante
            //el arreglo que creamos
            $usermodel->Add($user);
            //redireccionamos al index de usuarios
            header("location:http://localhost/php3d/?C=UserController&M=index");
        }
    }
}
?>