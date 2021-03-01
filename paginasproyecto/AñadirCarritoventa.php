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
$mysqli_link= mysqli_connect("localhost", "root", "", "viviroutrasvidas");
			if(mysqli_connect_errno())
			{
			  printf("MySQL connection failed with the error: %s", mysqli_connect_error());
			  exit;
			}


$selectquery="SELECT * FROM `libro_venta`";
$resultado1= mysqli_query($mysqli_link, $selectquery);

/*
$librosarray = array();
$selectotal="SELECT * FROM `libro_para_alquilar` FULL JOIN `libro_venta`;";
$selectotalresultado= mysqli_query($mysqli_link, $selectotal);
$contador1=1;
 while($fila1=mysqli_fetch_array($selectotalresultado, MYSQLI_ASSOC)){
 		$selectquery="SELECT * FROM `libro_para_alquilar`";
		$resultado1= mysqli_query($mysqli_link, $selectquery);

		$contador1++;
		while($fila2=mysqli_fetch_array($resultado1, MYSQLI_ASSOC)){
			if($fila2['ID']>-1&&$fila2['ID']<$contador1){

				echo $fila2['ID'];
				
			}
		 }
		}
		*/
//if(isset($_REQUEST["_".$librosarray[$i].'Carrito']))
//$librosarray = array();
$contador2=0;
  	 while($fila=mysqli_fetch_array($resultado1, MYSQLI_ASSOC)){
  	 		$librosarray[$contador2]=$fila['ID'];
  	 		$contador2++;

  	 }

for($i=0;$i<count($librosarray);$i++)
{
	//print_r($_REQUEST);
	//echo $_REQUEST["_".$librosarray[$i].'Carrito'];
  	 if(isset($_REQUEST["_".$librosarray[$i].'Carrito'])){
  	 	//echo $_REQUEST["_".$librosarray[$i].'Carrito'];
  	 		//echo $librosarray[$i];
			$selectquery="SELECT * FROM `libro_venta` WHERE ID ='$librosarray[$i]';";
			$resultado2= mysqli_query($mysqli_link, $selectquery);
			$contador=0;
  	 		while($fila=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
  	 				//echo $fila['ID'];
  	 				$contador3=0;
  	 				if(!isset($_SESSION['Compralibro'])){
  	 					$numero= 1;
  	 					//$arraylibros[$contador3]=array($fila['ID'],$fila['titulo'],$fila['precio'],$fila['foto']);
						$_SESSION['Compralibro']= $arraylibros[$contador3];
						//$update="UPDATE `libro_para_alquilar` SET cantidade=cantidade-$numero WHERE `libro_para_alquilar`.`ID`='$fila['ID']';";
						//mysqli_query($mysqli_link, $update); 
						$contador3++;
  	 				}
  	 				else{
  	 					$numero= 1;
  	 					//$arraylibros[$contador3]=array($fila['ID'],$fila['titulo'],$fila['precio'],$fila['foto']);
  	 					$_SESSION['Compralibro'][]= $fila['ID'];
  	 					//$arraylibros[$contador3];
  	 					//$update="UPDATE `libro_para_alquilar` SET cantidade=cantidade-$numero WHERE `libro_para_alquilar`.`ID`='$fila['ID']';";
						//mysqli_query($mysqli_link, $update);
						$contador3++;
  	 			}
  	 				$contador++;
  	 				header('Location:http://localhost/dashboard/paginasproyecto/PaginaComprar_Alquilar.php');




  	 		}



  	 }
  	 
  	}
  	
  	//print_r($_SESSION['Compralibro']);
  	mysqli_close($mysqli_link);

?>