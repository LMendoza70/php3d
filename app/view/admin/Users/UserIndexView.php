<div>
    <h1>Administracion de usuarios</h1>
    <p>
        en esta seeccion podremos tener el control de nuestros usuarios 
    </p>
    <p>
        <!-- en esta parte se debe de poner la ruta del controlador y el metodo que se va a ejecutar -->
        <!-- para llamar al formulario de agregar usuario -->                    
        <a href="http://localhost/php3d/?C=UserController&M=CallFormAdd">Agregar un nuevo usuario</a>
    </p>
    <table border=1>
        <thead>
            <tr>
                <td>Nombre</td>
                <td>Apellido Paterno</td>
                <td>Apellido Materno</td>
                <td>Usuario</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            <?php
                //while o cualquier ciclo que muestre los resultados de la funcion 
                //getAll del modelo usuarios
                foreach($datos as $dato){
                    echo "<tr>";
                    echo "<td>".$dato['Nombre']."</td>";
                    echo "<td>".$dato['ApPaterno']."</td>";
                    echo "<td>".$dato['ApMaterno']."</td>";
                    echo "<td>".$dato['Usuario']."</td>";
                    echo "<td> <button onclick='editar(".$dato['IdUser'].")'>Editar</button><br>
                    <button onclick='eliminar(".$dato['IdUser'].")'>Eliminar</button> </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</div>
<script>
    //creamos la funcion para eliminar un usuario por medio de su id y confirmamos si se desea eliminar
    function eliminar(id){
      if(confirm("¿Desea eliminar el usuario?")){
        window.location.href="http://localhost/php3d/?C=UserController&M=Delete&id="+id;
        
      }
    }
    //creamos la funcion para editar un usuario por medio de su id
    function editar(id){
      window.location.href="http://localhost/php3d/?C=UserController&M=CallFormEdit&id="+id;
    }
  </script>