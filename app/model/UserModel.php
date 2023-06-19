<?php
    class UserModel{
        //como atributo tendremos una llmada a la clase connection
        private $bdconnection;
        
        //creamos nuestro constructor 
        public function __construct(){
            //requerimos el archivo de coneccion a la base de datos 
            require_once('../config/coneccion.php');
            //asignamos la instancoia de la coneccion a bdconnection
            $this->bdconnection= new BDConnection();
        }

        //a partir de aqui vamos a crear todos los metodos que nos permitan  manipular 
        //la base de datos especificamente la entidad user

        //metodo para obtener todos los usuarios en la entidad user
        public function GetAll(){
            //creamos la consulta
            $sql="SELECT * FROM user";
            //conectamos con la base de datos //obtener la coneccion 
            $connection=$this->bdconnection->getConnection();
            //ejecutamos la consulta 
            $result=$connection->query($sql);
            //creamos un arreglo para almacenar cada uno de los usuarios obtenidos de la consulta
            $users=array();
            //creamos el resultado de la consulta
            
        }

    }
?>