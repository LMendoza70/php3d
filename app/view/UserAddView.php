<div>
  <h2>Agregar un nuevo usuario</h2>
  <form action="" method="post">
    <p>
      <label for="user">Usuario : </label
      ><input type="text" name="user" id="user" placeholder="Usuario..." />
    </p>
    <p>
      <label for="password">Password : </label
      ><input
        type="password"
        name="password"
        id="password"
        placeholder="Password..."
      />
    </p>
    <p>
      <label for="nombre">Nombre : </label
      ><input type="text" name="nombre" id="nombre" placeholder="Nombre..." />
    </p>
    <p>
      <label for="apate">Apellido Paterno : </label
      ><input
        type="text"
        name="apate"
        id="apate"
        placeholder="Apellido Paterno..."
      />
    </p>
    <p>
      <label for="amate">Apellido Materno : </label
      ><input
        type="text"
        name="amate"
        id="amate"
        placeholder="Apellido Materno..."
      />
    </p>
    <p>
      <label for="sex">Sexo : </label>
      <select name="sex" id="sex">
        <option value="0">Hombre</option>
        <option value="1">Muejer</option>
      </select>
    </p>
    <p>
      <label for="fchnac">Fecha de nacimiento : </label>
      <input type="date" name="fchnac" id="fchnac" />
    </p>
    <p><input type="submit" value="Agregar" /></p>
  </form>
</div>
