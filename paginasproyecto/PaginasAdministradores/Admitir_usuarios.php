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
                header('Location:http://www.pimedelio.com/index.php');
            }
              ?>

              <?php
              if (isset($_POST['Volver_inicio'])) {
                header('Location:http://www.pimedelio.com/paginasproyecto/PaginasAdministradores/PaginaAdministradores.php');


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
        $selectquery="SELECT * FROM `novo_rexistro` WHERE pagina_web='$idcontadorpaginas'";
      $resultado= mysqli_query($mysqli_link, $selectquery);
  	 while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
				$nuevousuario=$fila['usuario'];
				echo'<div align="center" id="usuario">';
				echo "<br></br>";
				echo "<p>".$nuevousuario."</p>";
				echo "<br></br>";
				echo'</div>';


	}
  		?>
  </div>

  <div align="center" id="Derecha">
  	<p>Datos</p>
  	<?php
  			if(!isset($_GET['page']))
      {

        $idcontadorpaginas=1;
      }
      else{
      $idcontadorpaginas=$_GET['page'];
    }
      $selectquery="SELECT * FROM `novo_rexistro` WHERE pagina_web='$idcontadorpaginas'";
      $resultado= mysqli_query($mysqli_link, $selectquery);
  	 while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        $nuevousuario=$fila['usuario'];
				$contraseñasql = $fila['contraseña'];
        $direccionsql = $fila['direccion'];
        $Nifdnisql = $fila['nifdni'];
        $nombresql = $fila['nombre'];
        $telefonosql = $fila['telefono'];
				echo'<div align="center" id="Datos">';
				echo "<br></br>";
				echo "<p>"."Contraseña: ".$contraseñasql."</p>";
				if($direccionsql==" "){
          echo "<p>Sin direccion</p>";
        }
          else{
            echo "<p>"."Direccion: ".$direccionsql."</p>";
          }

          if($Nifdnisql==" "){
            echo "<p>Sin Nifdni</p>";

          }

          else{
            echo "<p>"."NIFDNI: ".$Nifdnisql."</p>";

          }

          if($nombresql==" "){

            echo "<p>Sin nombre</p>";

          }
          else{
            echo "<p>"."Nombre: ".$nombresql."</p>";

          }

          if($telefonosql==" "){
            echo "<p>Sin teléfono</p>";

          }

          else{

            echo "<p>"."Teléfono: ".$telefonosql."</p>";

          }
        echo '<input type="checkbox" name="'."usuario".$nuevousuario.'" value="'.$nuevousuario.'">';
      
      
				echo'</div>';

		}
  		?>

  </div>
  
</div>
<?php
echo '<div>';
echo '<input type="submit" name="Validar_usuarios" value="Validar Usuarios">';
echo '</form>';
if(isset($_POST['Validar_usuarios'])){
      $usuariostotales=$_POST;
      $contadorusuarios=0;
      foreach ($usuariostotales as $key => $usuario) {
        if(isset($_POST['usuario'.$usuario])){
          $selectquery="SELECT * FROM `novo_rexistro`";
      $resultado= mysqli_query($mysqli_link, $selectquery);
      while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        if($fila['usuario']==$usuario){
            echo $usuario;
            $usuariosql=$fila['usuario'];
            $contraseña = $fila['contraseña'];
            $direccion = $fila['direccion'];
            $Nifdni = $fila['nifdni'];
            $nombre = $fila['nombre'];
            $telefono = $fila['telefono'];
            $insert="INSERT INTO `usuario`(`usuario`,`contraseña`,`nombre`,`direccion`,`telefono`,`nifdni`,`tipo_usuario`,`limite_inicios_sesion`) VALUES('$usuario','$contraseña','$nombre','$direccion',$telefono,'$Nifdni',0,0)";
              mysqli_query($mysqli_link,  $insert);
              $delete="DELETE FROM `novo_rexistro` WHERE `usuario`='$usuariosql'";
              mysqli_query($mysqli_link,$delete);
          } 
        }
        
               
      }
    }
               $contadorlibros=0;
               $contadorpaginas=1;
               $selectquery2="SELECT * FROM `novo_rexistro`";
               $resultado2= mysqli_query($mysqli_link, $selectquery2);
               if(mysqli_num_rows($resultado2)!=0){
                       while($fila2=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
                        $usuarios=$fila2['usuario'];
                        if($contadorlibros==3){
                          $contadorpaginas++;
                          $contadorlibros=0;

                        }
                         $update2="UPDATE `novo_rexistro` SET `pagina_web` = '$contadorpaginas' WHERE `usuario`='$usuarios';";
                        mysqli_query($mysqli_link,$update2);
                        $contadorlibros++;
                       }
                       //print_r($numeromayor);
                        }

     
     else{
      echo "<br></br>";
      echo "Valida algun usuario";
      echo "<br></br>";

     }
     header('Location:http://www.pimedelio.com/paginasproyecto/PaginasAdministradores/Admitir_usuarios.php');
   }
echo'</div>';

$selectquery="SELECT * FROM `novo_rexistro`";
$resultado= mysqli_query($mysqli_link, $selectquery);
$contadorpaginas=1;
$contadortotales=0;
$pagina=1;
$selectquery2="SELECT * FROM `novo_rexistro`";
$resultado= mysqli_query($mysqli_link, $selectquery2);
$filas=mysqli_num_rows($resultado);
     while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
      $pagina_web=$fila['pagina_web'];
      $saberlibrosquedan=$filas-$contadortotales;
      if($saberlibrosquedan==1){
          $href = 'Admitir_usuarios.php?page='.$pagina.'';
          echo '<button type=button onclick="window.location.href='."'".$href."'".'">'.$pagina."</button>";
          $pagina++;
          $contadortotales=0;
          $contadorpaginas=0;
      }
      if($contadorpaginas==3){
          $href = 'Admitir_usuarios.php?page='.$pagina.'';
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