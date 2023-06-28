<?php
    class UserModel{
        //como atributo tendremos una llmada a la clase connection
        private $bdconnection;
        
        //creamos nuestro constructor 
        public function __construct(){
            //requerimos el archivo de coneccion a la base de datos 
            require_once('app/config/coneccion.php');
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
            while($user =$result->fetch_assoc()){
                $users[]=$user;
            }
            //ya que tenemos los valores de la consulta en una variable que podemos manipular 
            //cerramos la coneccion 
            $bdconnection->closeConnection();
            //retornamos el resultado de la consulta (ya manipulable )
            return $users;          
        }

        public function getById($id){
            //paso 1 creamos la la consulta
                $sql='SELECT * FROM user WHERE IdUser= $id';
            //paso 2 conectamos con la base de datos
                $connection=$this->bdconnection->getConnection();
            //paso 3 ejecutamos la consulta
                $result =$connection->query($sql);
            //paso 4 preparar la respuesta 
            //verificamos si el id pasado como parametro trajo alguna respuedsta
                if($result && $result->num_rows > 0){
                    $user = $result->fetch_assoc();
                } else{
                    $user=false;
                }
            //paso 5 cerrar la coneccion
                $bdconnection->closeConnection();
            //paso 6 arrojar el resultado listo 
                return $user;
        }

        //metodo que nos permita validar
        public function getCredentials($user,$password){
            //paso 1 creamos la la consulta
                $sql='SELECT * FROM user WHERE Usuario == $user AND Password == $password';
            //paso 2 conectamos con la base de datos
                $connection=$this->bdconnection->getConnection();
            //paso 3 ejecutamos la consulta
                $result =$connection->query($sql);
            //paso 4 preparar la respuesta 
            //verificamos si el id pasado como parametro trajo alguna respuedsta
                if($result && $result->num_rows > 0){
                    $user = $result->fetch_assoc();
                } else{
                    $user=false;
                }
            //paso 5 cerrar la coneccion
                $bdconnection->closeConnection();
            //paso 6 arrojar el resultado listo 
                return $user;
        }

        //metodo para insertar usuarios 
        
        //metodo para eliminar usuarios 

        //metodo para actualizar 

        
    }
?>