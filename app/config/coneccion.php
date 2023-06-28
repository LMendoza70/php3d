<?php
 class BDConnection{
    //creamos el atributo de la clase coneccion para poder instanciar
    private $connection;

    //definimos el constructor de la clase conection 
    public function __construct(){
        //llmamos a una instancia de la configuracion
        require_once('app/config/config.php');
        //creqamos la coneccion a la base de datos 
        $this->connection = new mysqli(BD_HOST, BD_USER, BD_PASSWORD, DB_NAME);
        //manejo de errores en caso de que no se logre la coneccion 
        if($this->connection->connect_error)
        {
            die('Error de coneccion a la base de datos : '.$this->connection->connect->error);
        }
    }

    //creamos el metodo para el momento en que querramos abrir la coneccion a la BD
    public function getConecction(){
        return $this->connection;
    }

    //Creamos el metodo para cerrar la coneccion a la base de datos
    public function closeConnection(){
        $this->connection->close();
    }
 }
?>