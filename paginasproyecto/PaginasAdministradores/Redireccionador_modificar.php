<?php
session_start(); 

if(!isset($_SESSION['usuario'])){

  session_destroy();
  header('Location:http://www.pimedelio.com/paginasproyecto/index.php');
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

$titulospost=$_POST;
foreach ($titulospost as $idpost => $id) {

$selectquery="SELECT libro_para_alquilar.ID AS id_alquilar,libro_venta.ID AS id_venta from libro_para_alquilar RIGHT JOIN libro_venta ON libro_para_alquilar.ID=libro_venta.ID 
UNION ALL
SELECT libro_para_alquilar.ID AS id_alquilar,libro_venta.ID AS id_venta from libro_para_alquilar LEFT JOIN libro_venta ON libro_para_alquilar.ID=libro_venta.ID;";
$resultado= mysqli_query($mysqli_link, $selectquery);
  while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
    $id_alquilar=$fila['id_alquilar'];
      $id_venta=$fila['id_venta'];
if($idpost==$id_alquilar){               
  $href = 'Modificar_Libro.php?ID='.$idpost.'';
  header('Location:http://www.pimedelio.com/html/paginasproyecto/PaginasAdministradores/'.$href.'');
  break;

   }

   if($idpost==$id_venta){
     $href = 'Modificar_Libro.php?ID='.$idpost.'';
     header('Location:http://www.pimedelio.com/html/paginasproyecto/PaginasAdministradores/'.$href.'');
     break;

   }
 }
}

mysqli_close($mysqli_link);
?>