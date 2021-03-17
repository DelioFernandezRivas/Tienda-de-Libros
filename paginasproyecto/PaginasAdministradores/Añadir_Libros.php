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
		width:1000px;
      }
      #contenedor {
        margin:10 auto;
        height:1300px;
        padding:10px;
        width:1000px;
      }
      #contenedor2{
      	margin:10 auto;
        height:1600px;
        padding:10px;
        width:1000px;
      }
     
      #Izquierda {
        float:left;
        height:1000px;
        padding:10px;
        width:400px;
      }

    
      #Derecha {
        float:left;
        height:1000px;
        padding:10px;
        width:400px;
      }
  	</style>
  
  </head>
  <body>
<center>
	<div align="center" id="grancontenedor">
  <div id ="contenedor">
  <div align="center" id="Izquierda">
  		<p>Insertar Libros a Alquilar</p>
  		<?php
  			 if(!isset($_GET['page']))
      {

        $idcontadorpaginas=1;
      }
      else{
      $idcontadorpaginas=$_GET['page'];
    }
     echo '<form method="post">';
     for ($i=1; $i<=2 ; $i++) { 
     echo "<br></br>";
     echo "<table>";
     echo "<tr>";
     echo "<p>"."Libro: ".$i."</p>";
     echo  "<td><p>Id</p></td>";
     echo  "<td><input type='text' name=".'Id'.$i." required value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Titulo</p></td>";
     echo   "<td><input type='text' name=".'titulo'.$i." required value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Cantidad</p></td>";
     echo   "<td><input type='text' name=".'cantidad'.$i." value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Descripcion</p></td>";
     echo  "<td><textarea  type='text' name=".'descripcion'.$i." rows='10' cols='40' value=''> </textarea>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Editorial</p></td>";
     echo   "<td><input type='text' name=".'editorial'.$i." value=''> </td>";
     echo "</tr>";
     echo   "<td><p>Precio</p></td>";
     echo   "<td><input type='text' name=".'precio'.$i." required value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Foto</p></td>";
     echo   "<td><input type='text' name=".'foto'.$i." value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Libro</p></td>";
     echo   "<td><input type='text' name=".'libro'.$i." value=''> </td>";
     echo "</tr>";
     echo   "<td><p>Pagina Web</p></td>";
     echo   "<td><input type='text' name=".'pagina_web'.$i." value=''> </td>";
     echo "</tr>";
     echo "</table>";



    }

  echo '<input type="submit" name="Insertar_alquilar" value="Insertar libros">';
echo '</form>';
    
	
  		?>
  </div>

  <div align="center" id="Derecha">
  	<p>Insertar Libros a Comprar</p>
  	<?php
  			if(!isset($_GET['page']))
      {

        $idcontadorpaginas=1;
      }
      else{
      $idcontadorpaginas=$_GET['page'];
    }
      echo '<form method="post">';
  	 for ($i=1; $i<=2 ; $i++) { 
    echo "<br></br>";
     echo "<table>";
     echo "<tr>";
     echo "<p>"."Libro: ".$i."</p>";
     echo  "<td><p>Id</p></td>";
     echo  "<td><input type='text' name=".'Id'.$i." required value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Titulo</p></td>";
     echo   "<td><input type='text' name=".'titulo'.$i." required value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Cantidad</p></td>";
     echo   "<td><input type='text' name=".'cantidad'.$i." value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Descripcion</p></td>";
     echo  "<td><textarea  type='text' name=".'descripcion'.$i." rows='10' cols='40' value=''> </textarea>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Editorial</p></td>";
     echo   "<td><input type='text' name=".'editorial'.$i." value=''> </td>";
     echo "</tr>";
     echo   "<td><p>Precio</p></td>";
     echo   "<td><input type='text' name=".'precio'.$i." required value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Foto</p></td>";
     echo   "<td><input type='text' name=".'foto'.$i." value=''> </td>";
     echo "</tr>";
     echo "<tr>";
     echo   "<td><p>Pagina Web</p></td>";
     echo   "<td><input type='text' name=".'pagina_web'.$i." value=''> </td>";
     echo "</tr>";
     echo "</table>";


		}
echo '<input type="submit" name="Insertar_comprar" value="Insertar libros">';
echo '</form>';
  		?>

  </div>
</div>
<?php
if(isset($_POST['Insertar_alquilar'])){
      for ($i=1; $i<=2 ; $i++) { 
      if(isset($_POST['Id'.$i])||isset($_POST['pagina_web'.$i])){
        $id=$_POST['Id'.$i];
        $titulo=$_POST['titulo'.$i];
        $cantidad=$_POST['cantidad'.$i];
        $descripcion=$_POST['descripcion'.$i];
        $editorial=$_POST['editorial'.$i];
        $precio=$_POST['precio'.$i];
        $foto=$_POST['foto'.$i];
        $libro=$_POST['libro'.$i];
        $fotostr=str_replace("\\", "\\\\",$foto);
        $librostr=str_replace("\\", "\\\\",$libro);
        $paginaweb=$_POST['pagina_web'.$i];
        $insert="INSERT INTO `libro_para_alquilar`(`ID`,`titulo`,`cantidade`,`descripcion`,`editorial`,`precio`,`foto`,`libro`,`pagina_web`) VALUES('$id','$titulo','$cantidad','$descripcion','$editorial','$precio','$fotostr','$librostr','$paginaweb')";
        mysqli_query($mysqli_link,  $insert);

     }
   }
   }

   if(isset($_POST['Insertar_comprar'])){
      for ($i=1; $i<=2 ; $i++) { 
      if( isset($_POST['Id'.$i]) || isset($_POST['pagina_web'.$i])){
         $id=$_POST['Id'.$i];
        $titulo=$_POST['titulo'.$i];
        $cantidad=$_POST['cantidad'.$i];
        $descripcion=$_POST['descripcion'.$i];
        $editorial=$_POST['editorial'.$i];
        $precio=$_POST['precio'.$i];
        $foto=$_POST['foto'.$i];
        $fotostr=str_replace("\\", "\\\\",$foto);
        $paginaweb=$_POST['pagina_web'.$i];
        $insert2="INSERT INTO `libro_venta`(`ID`,`titulo`,`cantidade`,`descripcion`,`editorial`,`precio`,`foto`,`pagina_web`) VALUES('$id','$titulo','$cantidad','$descripcion','$editorial','$precio','$fotostr','$paginaweb')";
        mysqli_query($mysqli_link,  $insert2);

     }
   }
   }
 ?>
</div>
	</center>
  </body>
</html>
<?php

mysqli_close($mysqli_link);
?>