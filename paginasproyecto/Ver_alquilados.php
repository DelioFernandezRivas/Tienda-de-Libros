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
              echo '<p class="usuario">'.'Libros comprados o para alquilar '.$_SESSION['Cantidadlibros'].'</p>';
              //print_r($_SESSION['Compralibro']);
						?>
					  	<form method="post">
					    				<input text-align: center type="submit" name="volver_paginaprincipal" value="Salir Sesión">
					   				</form>
							<?php
							if (isset($_POST['volver_paginaprincipal'])) {
								session_destroy();
								header('Location:http://www.pimedelio.com/html/index.php');
						}

							if (isset($_POST['Volver_inicio'])) {
								header('Location:http://www.pimedelio.com/html/paginasproyecto/PaginaPrincipal.php');


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
        color:black;
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
       #Imagenes{
        float:left;
        height:300px;
        padding:10px;
        width:390px;


      }
      #Contenido{
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
  <div align="center" id ="contenedor">
  <div align="center" id="Izquierda">
  		<p>Imágenes</p>
  		<?php
       if(!isset($_GET['page']))
      {

        $idcontadorpaginas=1;
      }
      else{
      $idcontadorpaginas=$_GET['page'];
    }
  			$selectquery="SELECT * FROM `libro_alquilado3` WHERE usuario='$usuario' AND pagina_web='$idcontadorpaginas'";
			$resultado= mysqli_query($mysqli_link, $selectquery);
  	        while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
				$imagen=$fila['foto'];
				echo'<div align="center" id="Imagenes">';
				echo "<br></br>";
				echo "<img src='".$imagen."' width='100px'>";
				echo "<br></br>";
				echo'</div>';
}
  		?>
  </div>

  <div align="center" id="Derecha">
  	<p>Descripción</p>
  	<?php
     if(!isset($_GET['page']))
      {

        $idcontadorpaginas=1;
      }
      else{
      $idcontadorpaginas=$_GET['page'];
    }
  		$selectquery="SELECT * FROM `libro_alquilado3` WHERE usuario='$usuario' AND pagina_web='$idcontadorpaginas'";
			$resultado= mysqli_query($mysqli_link, $selectquery);
  	 while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
				$titulo=$fila['titulo'];
				$cantidade=$fila['cantidade'];
				$descripcion=$fila['descripcion'];
				$editorial=$fila['editorial'];
        $id=$fila['ID'];
        $pdf=$fila['libro'];
        $titulojunto=str_replace(' ', '', $titulo);
				echo'<div align="center" id="Contenido">';
				echo "<br></br>";
				echo "<p>".$titulo."</p>";
        if($cantidade==0){
          echo "<p>Alquila más para poder descargar</p>";
        }
          else{
            echo "<p>".$cantidade."</p>";
          }
				echo "<p>".$editorial."</p>";
        $selectquery2="SELECT Devolver FROM `libro_devuelto` WHERE `usuario`='$usuario' AND `ID`='$id' ";
        $resultado2= mysqli_query($mysqli_link, $selectquery2);
        $filas=mysqli_num_rows($resultado2);
        if($filas!=0){
        $selectquery2="SELECT Devolver FROM `libro_devuelto` WHERE `usuario`='$usuario' AND `ID`='$id'";
        $resultado2= mysqli_query($mysqli_link, $selectquery2);
        while ($fila2=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
            $sabervalidado=$fila2['Devolver'];
            }
        if($sabervalidado==1){
          echo '<a href='."Redireccionador.php?ID=".$id."&pagina=".$pdf.'>';
          echo "Descargar ".$titulo." y Devolver";
          echo '</a>';
          }
        else{
            echo "<p>Esperando por Validacion</p>";

         }
       }
       
       else{

        echo '<a href='."Redireccionador.php?ID=".$id."&pagina=".$pdf.'>';
        echo "Descargar ".$titulo." y Devolver";
        echo '</a>';
       }
        echo'</div>';
}
?>
  </div>
</div>
 <?php

$selectquery="SELECT * FROM `libro_alquilado3` WHERE usuario='$usuario';";
$resultado= mysqli_query($mysqli_link, $selectquery);
$contadorpaginas=1;
$contadortotales=0;
$pagina=1;
$selectquery2="SELECT * FROM `libro_alquilado3`WHERE usuario='$usuario';";
$resultado= mysqli_query($mysqli_link, $selectquery2);
$filas=mysqli_num_rows($resultado);
     while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
      $pagina_web=$fila['pagina_web'];
      $saberlibrosquedan=$filas-$contadortotales;
      if($saberlibrosquedan==1){
          $href = 'Ver_alquilados.php?page='.$pagina.'';
          echo '<button type=button onclick="window.location.href='."'".$href."'".'">'.$pagina."</button>";
          $pagina++;
          $contadortotales=0;
          $contadorpaginas=0;
      }
      if($contadorpaginas==3){
          $href = 'Ver_alquilados.php?page='.$pagina.'';
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