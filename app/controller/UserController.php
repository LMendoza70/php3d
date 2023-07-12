<?php
//incluimos en el documento de usercontroller el archivo de 
//user model para poder instanciarlo
include_once("app/model/UserModel.php");
class UserController
{
    //agregamos una instancia de nuestro modelo usuario
    private $usermodel;

    public function index()
    {
        //iniciamos session
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            //inicializamos nuestro modelo para poder instanciarlo
            $this->usermodel = new UserModel();
            //declaramos la variable datos, en la que almacenaremos lo que nos arroje el metodo
            //getall de el modelo usuarios para posteriormente mostrarlos en una tabla 
            $datos = $this->usermodel->GetAll();
            //define la ruta de la pagina a mostrar
            $vista = "app/view/admin/users/UserIndexView.php";
            //incluimos la plantilla principal para poder invocarla 
            include_once("app/view/admin/PlantillaView.php");
        } else {
            $vista = "app/view/admin/home.php";
            include_once("app/view/admin/Plantilla2View.php");
        }
    }

    public function CallFormLogin()
    {
        $vista = "app/view/LoginView.php";
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {

            include_once("app/view/admin/PlantillaView.php");
        } else {
            include_once("app/view/admin/Plantilla2View.php");
        }
    }

    public function Login()
    {
        $vista = "app/view/admin/home.php";
        //verificamos que el login llegue por post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usermodel = new UserModel();
            $usuario = $usermodel->getCredentials($_POST['user'], $_POST['password']);
            if ($usuario == false) {
                $x = "gess";
                include_once("app/view/admin/Plantilla2View.php");
            } else {
                $x = $usuario['Nombre'];
                session_start();
                $_SESSION['logedin'] = true;
                $_SESSION['nombre'] = $usuario['Nombre'] . ' ' . $usuario['ApPaterno'] . '' . $usuario['ApMaterno'];
                $_SESSION['avatar'] = $usuario['Avatar'];
                include_once("app/view/admin/PlantillaView.php");
            }
        }
    }

    //agregamos controladores diversos para invocar otros metodos (agregar usuario, eliminar , editar)


    //agregamos una funcion para llamar al formulario de agregar usuario
    public function CallFormAdd()
    {
        $vista = "app/view/admin/users/UserAddView.php";
        session_start();
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            include_once("app/view/admin/PlantillaView.php");
        } else {
            include_once("app/view/admin/Plantilla2View.php");
        }
    }

    //agregamos la funcion para agregar un usuario
    public function Add()
    {
        //verificamos que haya llegado a este metodo desde post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //creamos un arreglo para almacenar los datos del formulario y asi llamar 
            //al metodo adduser del modelo y pasarle los datos del formulario
            $user = array(
                'Usuario' => $_POST['user'],
                'Password' => $_POST['password'],
                'Nombre' => $_POST['nombre'],
                'ApPaterno' => $_POST['apate'],
                'ApMaterno' => $_POST['amate'],
                'Sexo' => $_POST['sex'],
                'FchNacimiento' => $_POST['fchnac'],
            );
            //comenzamos con el procesamiento de nuestra imagen 
            //verificamos que traiga algo en files
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                //obtener los datos de la imagen
                $nombreArchivo = $_FILES['avatar']['name'];
                $tipoArchivo = $_FILES['avatar']['type'];
                $tamanoArchivo = $_FILES['avatar']['size'];
                $rutaTemporal = $_FILES['avatar']['tmp_name'];
                //validamos el tipo de archivo que queremos subir
                $extencioes = array('jpeg', 'jpg', 'png', 'gif');
                $extencion = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if (!in_array($extencion, $extencioes)) {
                    echo "la imagen no tiene un formato aceptado en el servidor";
                    exit;
                }
                //validamos que el archivo tenga un tamaño adecuado
                $tamanomax = 2 * 1024 * 1024;
                if ($tamanoArchivo > $tamanomax) {
                    echo "ya mejor sube una pelicula o una lona NMms";
                    exit;
                }
                //generamos el nombre unico que se va a almacenar en el servidor 
                $nombreArchivo = uniqid('Avatar_') . '.' . $extencion;
                //definimos la ruta de almacenamiento
                $ruta = "app/src/img/avatars/" . $nombreArchivo;
                if (!move_uploaded_file($rutaTemporal, $ruta)) {
                    echo "Error al cargar la imagen a la ruta destino";
                    exit;
                }
                $user['Avatar'] = $nombreArchivo;
            }


            //creamos una instancia del modelo
            $usermodel = new UserModel();
            //llamamos al metodo adduser del modelo y le pasamos los datos del formulario mediante
            //el arreglo que creamos
            $res = $usermodel->Add($user);
            //redireccionamos al index de usuarios
            //podriamos poner una condicion if donde dependiendo de la respuesta te envie a una pantalla u otra

            header("location:http://localhost/php3d/?C=UserController&M=index");
        }
    }

    //creamos el metodo para llamar el formulario de editar usuario
    public function CallFormEdit()
    {
        //verificamos que el metodo de envio de datos sea GET
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //obtenemos el id del usuario a editar
            $id = $_GET['id'];
            //llamamos al metodo del modelo que obtiene los datos del usuario a editar
            $modelo = new UserModel();
            $datos = $modelo->getById($id);
            //llamamos a la vista de editar usuario
            $vista = 'app/View/admin/users/UserEditView.php';
            session_start();
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                include_once('app/view/admin/PlantillaView.php');
            } else {
                include_once('app/view/admin/Plantilla2View.php');
            }
        }
    }

    //creamos el metodo para editar un usuario
    public function Edit()
    {
        //verificamos que el metodo de envio de datos sea POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //almacenamos los datos enviados por el formulario en un arreglo
            $datos = array(
                'IdUser' => $_POST['id'], //agregamos el id del usuario a editar
                'Nombre' => $_POST['nombre'],
                'ApPaterno' => $_POST['apaterno'],
                'ApMaterno' => $_POST['amaterno'],
                'Usuario' => $_POST['user'],
                'Password' => $_POST['password'],
                'Sexo' => $_POST['sexo'],
                'FchNacimiento' => $_POST['fchnac'],
                'Avatar' => $_POST['ava']
            );

            //procesamos nuestra imagen
            //verificamos que traiga algo en files
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                //obtener los datos de la imagen
                $nombreArchivo = $_FILES['avatar']['name'];
                $tipoArchivo = $_FILES['avatar']['type'];
                $tamanoArchivo = $_FILES['avatar']['size'];
                $rutaTemporal = $_FILES['avatar']['tmp_name'];
                //validamos el tipo de archivo que queremos subir
                $extencioes = array('jpeg', 'jpg', 'png', 'gif');
                $extencion = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if (!in_array($extencion, $extencioes)) {
                    echo "la imagen no tiene un formato aceptado en el servidor";
                    exit;
                }
                //validamos que el archivo tenga un tamaño adecuado
                $tamanomax = 2 * 1024 * 1024;
                if ($tamanoArchivo > $tamanomax) {
                    echo "ya mejor sube una pelicula o una lona NMms";
                    exit;
                }
                //generamos el nombre unico que se va a almacenar en el servidor 
                $nombreArchivo = uniqid('Avatar_') . '.' . $extencion;
                //definimos la ruta de almacenamiento
                $ruta = "app/src/img/avatars/" . $nombreArchivo;
                if (!move_uploaded_file($rutaTemporal, $ruta)) {
                    echo "Error al cargar la imagen a la ruta destino";
                    exit;
                }
                //borramos el archivo anterior
                unlink('app/src/img/avatars/' . $_POST['ava']);


                $datos['Avatar'] = $nombreArchivo;
            } else {
                $datos['Avatar'] = $_POST['ava'];
            }

            //llamamos al metodo del modelo que actualiza los datos del usuario
            $modelo = new UserModel();
            $modelo->update($datos);
            //redireccionamos al index de usuarios
            header("Location:http://localhost/php3d/?C=UserController&M=index");
        }
    }

    //Creamos el metodo para eliminar un usuario de la base de datos, este metodo se llamara una vez que 
    //se haya confirmado la eliminacion del usuario en la vista de index mediante un confirm de javascript
    public function Delete()
    {
        //verificamos que el metodo de envio de datos sea GET
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //obtenemos el id del usuario a eliminar
            $id = $_GET['id'];
            //llamamos al metodo del modelo que elimina al usuario de la base de datos
            //obtengo el nombre de la imagen a borrar
            $this->usermodel = new UserModel();
            $anterior = $this->usermodel->getById($id);
            $modelo = new UserModel();
            $modelo->delete($id);
            //despues de elimar el registro elimino la imagen 
            unlink('app/src/img/avatars/' . $anterior['Avatar']);
            //redireccionamos al index de usuarios
            header("Location:http://localhost/php3d/?C=UserController&M=index");
        }
    }
}
