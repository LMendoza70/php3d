<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta</title>
</head>
<body>
    <?php
        $usuario=$_POST['user'];
        $constra=$_POST['password'];
        $us="luis";
        $pss="1234";
        $res="";
        
        if($us==$usuario && $pss==$constra){
            $res=" Correcto";
        }else{
            $res=" Incorrecto";
        }
    ?>
    <h1>Hola : <?php echo($usuario) ?> </h1>
    <h3>Tu logueo a sido : <?= $res ?> </h3>
</body>
</html>