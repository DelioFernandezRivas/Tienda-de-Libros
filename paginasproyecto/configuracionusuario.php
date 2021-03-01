<?php
session_start();
$mysqli_link= mysqli_connect("localhost", "root", "", "viviroutrasvidas");
//$sabernull=0;
if(mysqli_connect_errno())
{
  printf("MySQL connection failed with the error: %s", mysqli_connect_error());
  exit;
}
if(!isset($_SESSION['usuario'])){

	session_destroy();
  header('Location:http://localhost/dashboard/index.php');
	}
	if(isset($_SESSION['usuario'])){
	$usuariosesion=$_SESSION['usuario'];
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

$selectquery="SELECT * FROM `usuario` WHERE usuario= '$usuariosesion';";

$resultado=mysqli_query($mysqli_link, $selectquery);
 while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
 	$contraseñasql = $fila['contraseña'];
	$direccionsql = $fila['direccion'];
	$Nifdnisql = $fila['nifdni'];
	$nombresql = $fila['nombre'];
	$telefonosql = $fila['telefono'];
  $tipo_usuario=$fila['tipo_usuario'];
 	}
  if($direccionsql==""){
  $direccionsql="Nada";
  }
  if($Nifdnisql==""){
  $Nifdnisql="Nada";
  }
  if($nombresql==""){
  $nombresql="Nada";
  }
  if($telefonosql==0){
  $telefonosql="Sin Teléfono";

  if (isset($_POST['Enviar'])) { 
$contraseña = $_POST['Contraseña'];
$direccion = $_POST['Direccion'];
$Nifdni = $_POST['Nifdni'];
$nombre = $_POST['Nombre'];
$telefono = $_POST['Teléfono'];
if($direccion==""){
  $direccion=" ";
  }
  if($Nifdni==""){
  $Nifdni=" ";
  }
  if($nombre==""){
  $nombre=" ";
  }
  if($telefono==""){
  $telefono=0;
  }

if($tipo_usuario==0){
$update="UPDATE `usuario` SET `contraseña` = '$contraseña',`nombre`= '$nombre',`direccion`= '$direccion',`telefono` = '$telefono',`nifdni`= '$Nifdni',`tipo_usuario`=0,`limite_inicios_sesion`=0 WHERE `usuario`.`usuario`='$usuariosesion';";
mysqli_query($mysqli_link, $update); 
header('Location:http://localhost/dashboard/paginasproyecto/PaginaPrincipal.php');
}
else{
$update="UPDATE `usuario` SET `contraseña` = '$contraseña',`nombre`= '$nombre',`direccion`= '$direccion',`telefono` = '$telefono',`nifdni`= '$Nifdni',`tipo_usuario`=1,`limite_inicios_sesion`=0 WHERE `usuario`.`usuario`='$usuariosesion';";
mysqli_query($mysqli_link, $update); 
header('Location:http://localhost/dashboard/paginasproyecto/PaginasAdministradores/PaginaAdministradores.php');

}
}
  }
mysqli_close($mysqli_link);
?>

<html lang="en" dir="ltr">
<center>
  <head>
    <h1>Configuracion</h1>
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
    		<li style="list-style: none;">
				<form method="post">
    			    <div align="right" id="Sesion">
						<?php
						  $usuario=$_SESSION['usuario'];
							echo '<p class="usuario">'.$usuario.'</p>';
              echo '<p class="usuario">'.'Libros comprados o para alquilar '.$_SESSION['Cantidadlibros'].'</p>';
						?>
					  	<form method="post">
					    				<input text-align: center type="submit" name="volver_paginaprincipal" value="Salir Sesión">
					   				</form>
							<?php
							if (isset($_POST['volver_paginaprincipal'])) {
								session_destroy();
								header('Location:http://localhost/dashboard/index.php');
						}
							?>

	</div>
   				</form>
    		</li>
    	</ul>
    </nav>
  </head>
  <body>
    <?php 
      if (!empty($message)) 
      {
        echo "<p>".$message."</p>";
      }
    ?>
    <meta charset="utf-8">
    <table>
    	<tr>
        <td><p>Usuario</p></td>
        <td>
        	<?php
				echo "<p>".$usuariosesion."</p>";
        	?>

        </td>
      </tr>
    </table>
    <form method="post">
    <table>
      <tr>
      	<td>
      	<!--
      	<td><p>Contraseña Anterior</p></td>
        <td>
        	<?php
				//echo "<p>".$contraseñasql."</p>";
        	?>

        -->


        </td>
        <td><p>Contraseña Nueva</p></td>
        <td><input type="password" name="Contraseña" required value="<?php echo  $contraseñasql ?>"></td>
      </tr>
      <tr>
      	<td><p>Direccion Anterior</p></td>
        <td>
        	<?php
        		echo "<p>".$direccionsql."</p>";
        	?>


        </td>
        <td><p>Dirección Nueva</p></td>
        <td><input type="text" name="Direccion" value="<?php echo $direccionsql ?>"></td>
      </tr>
      <tr>
      	<td><p>Nif Anterior</p></td>
        <td>
        	<?php
        		echo "<p>".$Nifdnisql."</p>";
        	?>

        </td>
        <td><p>Nifdni Nuevo</p></td>
        <td><input type="text" name="Nifdni" value="<?php echo $Nifdnisql ?>"></td>
      </tr>
      <tr>
      	<td><p>Nombre Anterior</p></td>
        <td>
        	<?php
        		echo "<p>".$nombresql."</p>";
        	?>


        </td>
        <td><p>Nombre Nuevo</p></td>
        <td><input type="text" name="Nombre" value="<?php echo $nombresql ?>"></td>
      </tr>
      <tr>
      	<td><p>Teléfono Anterior</p></td>
        <td>
        	<?php
				echo "<p>".$telefonosql."</p>";
        	?>
        </td>
        <td><p>Teléfono Nuevo</p></td>
        <td><input type="text" name="Teléfono" value="<?php echo $telefonosql ?>"></td>
      </tr>
    </table>
    <input type="submit" name="Enviar" value="Aceptar Cambios">
    <input type="reset" value="Borrar información">
    </form>
    <table>
      <tr>
        <td>
          <?php
          if($tipo_usuario==0){
            //echo $tipo_usuario;
            echo '<button type=button onclick="document.location='."'"."PaginaPrincipal.php"."'".'">'."Volver"."</button>";

          }

          else{
            echo '<button type=button onclick="document.location='."'"."PaginasAdministradores/PaginaAdministradores.php"."'".'">'."Volver"."</button>";


          }



          ?>
          <!--<form method="get" action="ejercicios/Ejercicio1.html">
            <button type="submit">Crear Cuenta</button>
          </form>-->
<!--"window.location.href='https://w3docs.com';" como se insertar paginas de fuera-->
<!--"document.location='/';" insertar paginas de dentro-->
<!--<button onclick="document.location='/ejercicios/Ejercicio1.html';"> Crear Cuenta</button>-->
        </td>
        </table>
      <!--  <script src="scripts/crear_cuenta.js"></script>-->
        </body>
    </center>
</html>