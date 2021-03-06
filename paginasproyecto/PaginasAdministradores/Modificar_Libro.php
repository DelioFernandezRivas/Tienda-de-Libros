<?php
session_start(); 

if(!isset($_SESSION['usuario'])){

	session_destroy();
  header('Location:../index.php');
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
                header('Location:../index.php');
            }
              ?>

              <?php
              if (isset($_POST['Volver_inicio'])) {
                header('Location:PaginaAdministradores.php');


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
		width:1000px;
      }
      #contenedor {
        margin:10 auto;
        height:700px;
        padding:10px;
        width:1000px;
      }
      #contenedor2{
      	margin:10 auto;
        height:500px;
        padding:10px;
        width:1000px;
      }
     
      #Izquierda {
        float:left;
        height:500px;
        padding:10px;
        width:400px;
      }

    
      #Derecha {
        float:left;
        height:600px;
        padding:10px;
        width:400px;
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
  		<p>Libro</p>
  		<?php
      $idget=$_GET['ID'];
      if($idget<300){
      $selectquery="SELECT * FROM `libro_para_alquilar` WHERE ID='$idget'";
      $resultado= mysqli_query($mysqli_link, $selectquery);
      while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        $titulo=$fila['titulo'];
        $cantidade=$fila['cantidade'];
        $descripcion=$fila['descripcion'];
        $editorial=$fila['editorial'];
        $precio=$fila['precio'];
        $id=$fila['ID'];
        $libro=$fila['libro'];
        $imagen=$fila['foto'];
        $pagina_web=$fila['pagina_web'];
        echo'<div align="center" id="Imagenes">';
        echo "<br></br>";
        echo "<img src='"."..\\".$imagen."' width='100px'>";
        echo "<br></br>";
        echo'</div>';
      }
    }
      else{
      $selectquery="SELECT * FROM `libro_venta` WHERE ID='$idget'";
      $resultado= mysqli_query($mysqli_link, $selectquery);
      while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        $titulo=$fila['titulo'];
        $cantidade=$fila['cantidade'];
        $descripcion=$fila['descripcion'];
        $editorial=$fila['editorial'];
        $precio=$fila['precio'];
        $id=$fila['ID'];
        $imagen=$fila['foto'];
        $pagina_web=$fila['pagina_web'];
        echo'<div align="center" id="Imagenes">';
        echo "<br></br>";
        echo "<img src='"."..\\".$imagen."' width='200px'>";
        echo "<br></br>";
        echo'</div>';
      }


      }
	
  		?>
  </div>

  <div align="center" id="Derecha">
  	<p>Datos a Modificar</p>
  	<?php
     echo "<br></br>";
     echo "<table>";
     echo "<tr>";
     echo "<p>"."Libro: ".""."</p>";
     echo "<tr>";
     echo   "<td><p>Titulo</p></td>";
     echo   "<td><input type='text' name=".'titulo'.""." required value='".$titulo."'> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Cantidad</p></td>";
     echo   "<td><input type='text' name=".'cantidad'.""." value='".$cantidade."'> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Descripcion</p></td>";
     echo  "<td><textarea  type='textarea' name=".'descripcion'.""." rows='10' cols='100' value='".$descripcion."'>".$descripcion."</textarea>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Editorial</p></td>";
     echo   "<td><input type='text' name=".'editorial'.""." value='".$editorial."'> </td>";
     echo "</tr>";
     echo   "<td><p>Precio</p></td>";
     echo   "<td><input type='text' name=".'precio'.""." required value='".$precio."'> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Foto</p></td>";
     echo   "<td><input type='text' name=".'foto'.""." value='".$imagen."'> </td>";
     echo "</tr>";
     echo "<tr>";
     if($idget<300){
     echo   "<td><p>Libro</p></td>";
     echo   "<td><input type='text' name=".'libro'.""." value='".$libro."'> </td>";
     echo "</tr>";
   }
     echo "<tr>";
     echo   "<td><p>Pagina Web</p></td>";
     echo   "<td><input type='text' name=".'pagina_web'.""." value='".$pagina_web."'> </td>";
     echo "</tr>";
     echo "</table>";


		
  		?>

  </div>
</div>
<?php
echo '<div>';
echo '<input type="submit" name="Modificar_libro" value="Modificar libro">';
echo '<input type="reset" value="Resetear Valores">';
echo '</form>';
echo '</div>';
if(isset($_POST['Modificar_libro'])){
        $idget=$_GET['ID'];
        $titulo=$_POST['titulo'];
        //echo $titulo;
        $cantidad=$_POST['cantidad'];
        $descripcion=$_POST['descripcion'];
        $editorial=$_POST['editorial'];
        $precio=$_POST['precio'];
        $foto=$_POST['foto'];
        $fotostr=str_replace("\\", "\\\\",$foto);
        if($idget<300){
        $libro=$_POST['libro'];
        $librostr=str_replace("\\", "\\\\",$libro);
      }
        $paginaweb=$_POST['pagina_web'];
        if($idget<300){

         $update="UPDATE `libro_para_alquilar` SET `titulo` = '$titulo', `cantidade` = '$cantidad', `descripcion` = '$descripcion', `editorial` = '$editorial', `precio` = '$precio', `foto` = '$fotostr', `libro` = '$librostr',
          `pagina_web` = '$paginaweb' WHERE `ID` = '$idget'";   
        
        mysqli_query($mysqli_link,$update);
      }

      else{
        $update="UPDATE `libro_venta` SET `titulo` = '$titulo', `cantidad` = '$cantidad', `descripcion` = '$descripcion', `editorial` = '$editorial', `precio` = '$precio', `foto` = '$foto',
          `pagina_web` = '$paginaweb' WHERE `ID` = '$idget'";   
        
        mysqli_query($mysqli_link,$update);

      }

     }
  

 ?>
 <button onclick="document.location='Modificar_Libros.php';"> Volver a Modificar Libros</button>
</div>
	</center>
  </body>
</html>
<?php

mysqli_close($mysqli_link);
?>