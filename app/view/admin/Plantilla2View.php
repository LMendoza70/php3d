<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catando Ando Coffee Shop</title>
    <link rel="stylesheet" href="app/view/style.css">
</head>

<body>
    <header class="header">
        <h1>Catando ando Coffee Shop</h1>
        <nav class="navbar">
            <ul>
                <li><a href="http://localhost/php3d/">Inicio</a></li>
                <li><a href="http://localhost/php3d?C=UserController&M=CallFormLogin">Login</a></li>
            </ul>
    </header>
    <section class="container">
        <!-- aqui vamos a llamar a los elementos que vamos a mostrar posteriormente-->
        <?php include_once($vista); ?>
    </section>
    <footer class="footer">
        <h3>Derechos reservados</h3>
    </footer>

</body>

</html>