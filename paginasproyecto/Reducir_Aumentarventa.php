<?php

session_start(); 

if(!isset($_SESSION['usuario'])){

	session_destroy();
  header('Location:http://www.pimedelio.com/index.php');
	}

	if(isset($_SESSION['usuario'])){
	$usuario=$_SESSION['usuario'];
}
$libros=$_SESSION['Compralibro'];
  include 'Conexion.php';
	if(mysqli_connect_errno())
	{
	  printf("MySQL connection failed with the error: %s", mysqli_connect_error());
	  exit;
	}
 
$selectquery="SELECT * FROM `libro_venta`";
$resultado1= mysqli_query($mysqli_link, $selectquery);
$resultado2= mysqli_query($mysqli_link, $selectquery);
$numero=0;

$contador2=0;
  	 while($fila=mysqli_fetch_array($resultado1, MYSQLI_ASSOC)){
  	 		$librosarray[$contador2]=$fila['ID'];
  	 		$contador2++;

  	 }

for($i=0;$i<count($librosarray);$i++)
{
      if(isset($_REQUEST["_".$librosarray[$i].'Reducir'])){
     		foreach ($_SESSION['Compralibro'] as $key => $ID) {
          if(array_search($librosarray[$i], $_SESSION['Compralibro']) == $key ){
                $valorinicial=array_key_first($_SESSION['Compralibro']);
                unset($_SESSION['Compralibro'][$key]);
                array_splice($_SESSION['Compralibro'],$key,$valorinicial);
                header('Location:http://www.pimedelio.com/PaginaComprar_Alquilar.php');
                break;
              } 
            }
         }

     if(isset($_REQUEST["_".$librosarray[$i].'Eliminar'])) {
       foreach ($_SESSION['Compralibro'] as $keyprimera => $ID) {
          if(array_search($librosarray[$i], $_SESSION['Compralibro']) == $keyprimera ){
                $id=array_search($librosarray[$i], $_SESSION['Compralibro']);
                $saberposicion=array_keys($_SESSION['Compralibro'],$librosarray[$i]); 
                $valorinicial=array_key_first($_SESSION['Compralibro']);
                foreach ($saberposicion as $key => $keyanterior) {
                  unset($_SESSION['Compralibro'][$keyanterior]);
                }
                array_splice($_SESSION['Compralibro'],$keyprimera,$valorinicial);
                header('Location:http://www.pimedelio.com/PaginaComprar_Alquilar.php');
              }
            }
          }
   
                   
        
         if(isset($_REQUEST["_".$librosarray[$i].'Aumentar'])){
          array_push($_SESSION['Compralibro'], $librosarray[$i]);
          header('Location:http://www.pimedelio.com/PaginaComprar_Alquilar.php');
      }
      next($_SESSION['Compralibro']);
      next($librosarray);
  }


  mysqli_close($mysqli_link);
?>