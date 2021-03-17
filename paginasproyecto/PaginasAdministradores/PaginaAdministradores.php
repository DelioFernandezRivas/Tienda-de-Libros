<?php
session_start(); 

if(!isset($_SESSION['usuario'])){

  session_destroy();
  header('Location:http://www.pimedelio.com/index.php');
  }
  if(isset($_SESSION['usuario'])){
  $usuario=$_SESSION['usuario'];
}
if(!isset($_SESSION['Compralibro'])){

  $_SESSION['Compralibro']=array();;
  }
  if(!isset($_SESSION['Cantidadlibros'])){

  $_SESSION['Cantidadlibros']=0;
  }
  if(isset($_SESSION['Cantidadlibros'])){
    if(count($_SESSION['Compralibro'])!=NULL){
    $_SESSION['Cantidadlibros']=count($_SESSION['Compralibro']);

  }
  else{

    $_SESSION['Cantidadlibros']=0;

  }
  }
include 'Conexion.php';
      if(mysqli_connect_errno())
      {
        printf("MySQL connection failed with the error: %s", mysqli_connect_error());
        exit;
      }
?>

<!DOCTYPE html>
<html>
<head>
  <script>
        if (window.history.replaceState) { // verificamos disponibilidad
         window.history.replaceState(null, null, window.location.href);
    }

      </script>
    <style type="text/css">
   p.usuario {
    text-align: right



   }
   </style>
    <center>
    <meta charset="utf-8">
    <nav id="Menu">
      <ul>
        <li>
          <div align="center" id="Comprar">
        </div>
              <div align="right" id="Sesion">
            <?php
              echo '<p class="usuario">'.$usuario.'</p>';
              echo '<p class="usuario">'.'Bienvenido admin'.'</p>';
            ?>
              <form method="post">
                      <input text-align: center type="submit" name="volver_paginaprincipal" value="Salir Sesión">
                      <input text-align: center type="submit" name="configuracion" value="Configuracion">
                    </form>
              <?php
              if (isset($_POST['volver_paginaprincipal'])) {
                session_destroy();
                header('Location:http://www.pimedelio.com/index.php');
            }

              if(isset($_POST['configuracion'])){

                header('Location:http://www.pimedelio.com/paginasproyecto/configuracionusuario.php');

              }
              ?>

  </div>
        </li>
      </ul>
    </nav>
  <style>
       * { 
        margin:2;
        padding:2;
      }
      a:link, a:visited, a:hover, a:active {
        color:#0f0;
        font-size:16px;
      }
      body {
        background:#eee;
        font-family:verdana;
      }
      h1 {
        color:#c0c;
        font-size:24px;
      }
      p {
        font-size:16px;
      }
      ul {
        list-style-type:none;
      }

      #grancontenedor{
    margin:10 auto;
    height:1000px;
    width:1000px;
      }
      #contenedor {
        margin:10 auto;
        height:20px;
        padding:10px;
        width:900px;
      }
      #contenedor2{
           margin:10 auto;
        height:300px;
        padding:10px;
        width:900px;
      }
      #Izquierda_boton {
        float:left;
        height:20px;
        padding:0px;
        width:300px;
      }

      #centro_boton{
        float:left;
        height:20px;
        padding:0px;
        width:300px;



      }

    
      #Derecha_boton {
        float:left;
        height:20px;
        padding:0px;
        width:300px;
      }

      #Izquierda {
        float:left;
        height:300px;
        padding:0px;
        width:300px;
      }

      #centro{
        float:left;
        height:300px;
        padding:0px;
        width:300px;



      }

    
      #Derecha {
        float:left;
        height:300px;
        padding:0px;
        width:300px;
      }
    </style>
  <script>
        if (window.history.replaceState) { // verificamos disponibilidad
         window.history.replaceState(null, null, window.location.href);
    }
</script>
  <title></title>
</center>
</head>
<body>
  <center>

  <div id="grancontenedor">
  <div id ="contenedor">
  <div id="Izquierda_boton">
      <button onclick="document.location='Admitir_usuarios.php';"> Admintir Nuevos Usuarios</button>
  </div>

  <div id="centro_boton">
    <button onclick="document.location='Añadir_Libros.php';"> Insertar Nuevos Libros</button>
  </div>

  <div id="Derecha_boton">
      <button onclick="document.location='Eliminar_Libros.php';"> Eliminar Libros</button>
  </div>
</div>
<div id="contenedor2">
  <div id="Izquierda">
    <img src='..\ImagenesIAW\usuario_admitido.jpg' width='200px'>
  </div>
  <div id="centro">
    <img src='..\ImagenesIAW\insertar_libros.jpg' width='200px'>
  </div>
  <div id="Derecha">
    <img src='..\ImagenesIAW\eliminar_libros.jpg' width='200px'>
  </div>

</div>
<div id ="contenedor">
  <div id="Izquierda_boton">
      <button onclick="document.location='Modificar_Libros.php';"> Modificar Libros</button>
  </div>

  <div id="centro_boton">
    <button onclick="document.location='Sacar_informes.php';"> Sacar Informes</button>
  </div>

  <div id="Derecha_boton">
      <button onclick="document.location='Devolucion_Libros.php';"> Devolución Libros</button>
  </div>
</div>
<div id="contenedor2">
  <div id="Izquierda">
    <img src='..\ImagenesIAW\modificar_libros.jfif' width='200px'>
  </div>
  <div id="centro">
    <img src='..\ImagenesIAW\sacar_informes.jpg' width='200px'>
  </div>
  <div id="Derecha">
    <img src='..\ImagenesIAW\devolver_libros_admin.jpg' width='200px'>
  </div>

</div>

</div>
</center>

</body>
</html>
<?php
mysqli_close($mysqli_link);
?>