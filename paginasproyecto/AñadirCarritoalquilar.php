<?php


session_start(); 

if(!isset($_SESSION['usuario'])){

	session_destroy();
  header('Location:http://localhost/dashboard/index.php');
	}

	if(isset($_SESSION['usuario'])){
	$usuario=$_SESSION['usuario'];
}
$libros=array();
include 'Conexion.php';
			if(mysqli_connect_errno())
			{
			  printf("MySQL connection failed with the error: %s", mysqli_connect_error());
			  exit;
			}


$selectquery="SELECT * FROM `libro_para_alquilar`";
$resultado1= mysqli_query($mysqli_link, $selectquery);

$contador2=0;
  	 while($fila=mysqli_fetch_array($resultado1, MYSQLI_ASSOC)){
  	 		$librosarray[$contador2]=$fila['ID'];
  	 		$contador2++;

  	 }

for($i=0;$i<count($librosarray);$i++)
{
  	 if(isset($_REQUEST["_".$librosarray[$i].'Carrito'])){
  	 	echo $_REQUEST["_".$librosarray[$i].'Carrito'];
			$selectquery="SELECT * FROM `libro_para_alquilar` WHERE ID ='$librosarray[$i]';";
			$resultado2= mysqli_query($mysqli_link, $selectquery);
			$contador=0;
  	 		while($fila=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
  	 				$contador3=0;
  	 				if(!isset($_SESSION['Compralibro'])){
  	 					$numero= 1;
						$_SESSION['Compralibro']= $fila['ID'];
						$contador3++;
  	 				}
  	 				else{
  	 					$numero= 1;
  	 					$_SESSION['Compralibro'][]= $fila['ID'];
						$contador3++;
  	 			}
  	 				$contador++;
  	 				header('Location:PaginaComprar_Alquilar.php');


  	 		}



  	 }
  	}
  	
  	mysqli_close($mysqli_link);

?>