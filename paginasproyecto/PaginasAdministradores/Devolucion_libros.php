<?php
session_start(); 

if(!isset($_SESSION['usuario'])){

	session_destroy();
  header('Location:http://www.pimedelio.com/html/index.php');
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
<html lang="en" dir="ltr">
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
        <form method="post">
            <input type="submit" name="Volver_inicio" value="Volver Inicio">
            </form>
              <div align="right" id="Sesion">
            <?php
              echo '<p class="usuario">'.$usuario.'</p>';
            ?>
              <form method="post">
                      <input text-align: center type="submit" name="volver_paginaprincipal" value="Salir Sesión">
                    </form>
              <?php
              if (isset($_POST['volver_paginaprincipal'])) {
                session_destroy();
                header('Location:http://www.pimedelio.com/html/index.php');
            }
              ?>

              <?php
              if (isset($_POST['Volver_inicio'])) {
                header('Location:http://www.pimedelio.com/html/paginasproyecto/PaginasAdministradores/PaginaAdministradores.php');


}

              ?>

  </div>
        </li>
      </ul>
    </nav>
</center>
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
		width:1100px;
      }
      #contenedor {
        margin:10 auto;
        height:1100px;
        padding:10px;
        width:1100px;
      }
      #contenedor2{
      	margin:10 auto;
        height:1100px;
        padding:10px;
        width:1000px;
      }
     
      #Izquierda {
        float:left;
        height:300px;
        padding:10px;
        width:400px;
      }

    
      #Derecha {
        float:left;
        height:300px;
        padding:10px;
        width:400px;
      }

      #usuario{
        float:left;
        height:300px;
        padding:10px;
        width:390px;


      }
       #centro{
        float:left;
        height:100px;
        padding:0px;
        width:1000px;



      }
        #Datos{
        float:left;
        height:300px;
        padding:10px;
        width:390px;


      }
  	</style>
  
  </head>
  <body>
<center>
	<div align="center" id="grancontenedor">
    <?php 
    echo '<form method='."'post'".'>';

    ?>
  <div id ="contenedor">
  <div align="center" id="Izquierda">
  		<p>Usuario</p>
  		<?php
  			 if(!isset($_GET['page']))
      {

        $idcontadorpaginas=1;
      }
      else{
      $idcontadorpaginas=$_GET['page'];
    }
        $selectquery="SELECT usuario FROM `libro_devuelto` WHERE pagina_web='$idcontadorpaginas'";
      $resultado= mysqli_query($mysqli_link, $selectquery);
  	 while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
				$usuario=$fila['usuario'];
				echo'<div align="center" id="usuario">';
				echo "<br></br>";
				echo "<p>".$usuario."</p>";
				echo "<br></br>";
				echo'</div>';
	}
  		?>
  </div>

  <div align="center" id="Derecha">
  	<p>Libro a Devolver</p>
  	<?php
  			if(!isset($_GET['page']))
      {

        $idcontadorpaginas=1;
      }
      else{
      $idcontadorpaginas=$_GET['page'];
    }
      $selectquery="SELECT * FROM `libro_devuelto` WHERE pagina_web='$idcontadorpaginas'";
      $resultado= mysqli_query($mysqli_link, $selectquery);
  	 while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        $titulo=$fila['titulo'];
        $descripcion=$fila['descripcion'];
        $editorial=$fila['editorial'];
        $id=$fila['ID'];
        $usuariosql=$fila['usuario'];
        $imagen=$fila['foto'];
        $devuelto=$fila['Devolver'];
        echo'<div align="center" id="Contenido">';
        echo "<br></br>";
        echo "<img src='"."..\\".$imagen."' width='100px'>";
        echo "<p>".$id."</p>";
        echo "<p>".$titulo."</p>";
        echo "<p>".$editorial."</p>"; 
        if($devuelto==0){
          echo '<input type="checkbox" name="'."Devolver".$id.'" value="'.$id.'">';
      }
        else{

          echo "<p>"."Libro Devuelto"."</p>";

        }
        echo '<input type="hidden" name="'."Usuario".$usuariosql.'" value="'.$usuariosql.'">';
        echo'</div>';

		}
  		?>

  </div>
  
</div>
<?php
echo '<div>';
echo '<input type="submit" name="Devolver_libros" value="Validar Libros Devueltos">';
echo '</form>';
if(isset($_POST['Devolver_libros'])){
  $arraypost=$_POST;
  print_r($arraypost);
  $arrayids=array();
  $arrayusuarios=array();
  $contador=0;
      foreach ($arraypost as $key => $valores) {
        if(isset($_POST['Devolver'.$valores])){
          $arrayids[$contador]=$valores;

        }
        if(isset($_POST['Usuario'.$valores])){

          $arrayusuarios[$contador]=$valores;

        }
        $contador++;

      }
      foreach ($arrayids as $key => $id) {
        foreach ($arrayusuarios as $key => $usuario) {
       
      $update="UPDATE `libro_devuelto` SET `Devolver` = 1 WHERE `ID`='$id' AND `usuario`='$usuario';";
      mysqli_query($mysqli_link,$update);
}
}
     header('Location:Devolucion_libros.php');
   }
echo'</div>';

$selectquery="SELECT * FROM `libro_devuelto`";
$resultado= mysqli_query($mysqli_link, $selectquery);
$contadorpaginas=1;
$contadortotales=0;
$pagina=1;
$selectquery2="SELECT * FROM `libro_devuelto`";
$resultado= mysqli_query($mysqli_link, $selectquery2);
$filas=mysqli_num_rows($resultado);
     while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
      $pagina_web=$fila['pagina_web'];
      $saberlibrosquedan=$filas-$contadortotales;
      if($saberlibrosquedan==1){
          $href = 'Devolucion_libros.php?page='.$pagina.'';
          echo '<button type=button onclick="window.location.href='."'".$href."'".'">'.$pagina."</button>";
          $pagina++;
          $contadortotales=0;
          $contadorpaginas=0;
      }
      if($contadorpaginas==3){
          $href = 'Devolucion_libros.php?page='.$pagina.'';
          echo '<button type=button onclick="window.location.href='."'".$href."'".'">'.$pagina."</button>";
          $pagina++;
          $contadorpaginas=0;
        }
          $contadorpaginas++;
          $contadortotales++;
     }


     
  ?>
</div>
	</center>
  </body>
</html>
<?php

mysqli_close($mysqli_link);
?>