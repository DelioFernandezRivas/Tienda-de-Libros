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

  $_SESSION['Compralibro']=array();
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
  if(!isset($_SESSION['Librosalquilar'])){

  $_SESSION['Librosalquilar']=array();
  }
  if(!isset($_SESSION['Libroscomprar'])){

  $_SESSION['Libroscomprar']=array();
  }
include 'Conexion.php';
			if(mysqli_connect_errno())
			{
			  printf("MySQL connection failed with the error: %s", mysqli_connect_error());
			  exit;
			}

if (isset($_POST['Sacar_Tikect'])) {
// CONFIGURACIÓN PREVIA
$total=0;
$fecha=date("d").':'.date("m").':'.date("y");
require('../fpdf182/fpdf.php');
define('EURO',chr(128)); // Constante con el símbolo Euro.
$pdf = new FPDF('P','mm',array(80,150)); // Tamaño tickt 80mm x 150 mm (largo aprox)
$pdf->AddPage();
 
// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(60,4,'TiendaDelio.com',0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(60,4,'C.I.F.: 50604030L',0,1,'C');
$pdf->Cell(60,4,'C/ Pousada, 98A',0,1,'C');
$pdf->Cell(60,4,'C.P.: 36142 Vilaboa (Pontevedra)',0,1,'C');
$pdf->Cell(60,4,'999 888 777',0,1,'C');
$pdf->Cell(60,4,'deliofernandez1998@gmail.com',0,1,'C');
 
// DATOS FACTURA        
$pdf->Ln(5);
$pdf->Cell(60,4,'Datos de Usuario',0,1,'C');
$selectquery3="SELECT * FROM `usuario` where usuario='$usuario'";
$resultado3= mysqli_query($mysqli_link, $selectquery3);
while($fila3=mysqli_fetch_array($resultado3, MYSQLI_ASSOC)){
  $direccionsql = $fila3['direccion'];
  $Nifdnisql = $fila3['nifdni'];
  $nombresql = $fila3['nombre'];
  $telefonosql = $fila3['telefono'];

}
if(is_null($direccionsql)){
$pdf->Cell(60,4,utf8_decode('Dirección: '.'Sin dirección'),0,1,'');
}
else{
$pdf->Cell(60,4,utf8_decode('Dirección: '.$direccionsql),0,1,'');

}
if(is_null($Nifdnisql)){
  $pdf->Cell(60,4,utf8_decode('NIF/DNI: '.'Sin NIF/DNI'),0,1,'');
}
else{

  $pdf->Cell(60,4,utf8_decode('NIF/DNI: '.$Nifdnisql),0,1,'');
}
if(is_null($nombresql)){
  $pdf->Cell(60,4,utf8_decode('Nombre: '.'Sin Nombre'),0,1,'');
}
else{
$pdf->Cell(60,4,utf8_decode('Nombre: '.$nombresql),0,1,'');
  
}
if(is_null($telefonosql)){
  $pdf->Cell(60,4,utf8_decode('Teléfono: '.'Sin teléfono'),0,1,'');
}
else{
$pdf->Cell(60,4,utf8_decode('Teléfono: '.$telefonosql),0,1,'');
  
}
$pdf->Cell(60,4,utf8_decode('Fecha de compra: '.$fecha),0,1,'');


$totalprecioalquilar=array();
$totalpreciocomprar=array();
if(count( $_SESSION['Librosalquilar'])!=0){
//Alquilar
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10, 'Alquilado durante 30 Dias', 0);
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(0);
// Columna Alquilar
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10, 'Articulo', 0);
$pdf->Cell(5, 10, 'Ud',0,0,'R');
$pdf->Cell(10, 10, 'Precio',0,0,'R');
$pdf->Cell(15, 10, 'Total',0,0,'R');
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(0);

// PRODUCTOS
$arraycuenta=array_count_values($_SESSION['Librosalquilar']);
$selectquery="SELECT * FROM `libro_para_alquilar`";
$resultado= mysqli_query($mysqli_link, $selectquery);
while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
	foreach ($_SESSION['Librosalquilar'] as $key => $ID) {
		if($ID==$fila['ID']){
		foreach ($arraycuenta as $IDcuenta => $cuenta) {
			if($ID==$fila['ID'] && $IDcuenta==$fila['ID']){
				$pdf->SetFont('Helvetica', '', 7);
				$pdf->MultiCell(30,4,utf8_decode($fila['titulo']),0,'L'); 
				$pdf->Cell(35, -5, $cuenta,0,0,'R');
				$pdf->Cell(10, -5, number_format(round($fila['precio']), 2, ',', ' ').EURO,0,0,'R');
				$pdf->Cell(15, -5, number_format(round($cuenta*$fila['precio']), 2, ',', ' ').EURO,0,0,'R');
				$pdf->Ln(3);
				$numero=number_format(round($cuenta*$fila['precio']), 2, ',', ' ');
				for ($i=0; $i <count($arraycuenta) ; $i++) { 
					$totalprecioalquilar[$i]=$numero;
				}

				}
			}
			break;
		}
	}
}
}
if(count( $_SESSION['Libroscomprar'])!=0){
//Comprar
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10, 'Comprado', 0);
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(0);
// Columna Comprar
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10, 'Articulo', 0);
$pdf->Cell(5, 10, 'Ud',0,0,'R');
$pdf->Cell(10, 10, 'Precio',0,0,'R');
$pdf->Cell(15, 10, 'Total',0,0,'R');
$pdf->Ln(8);
$pdf->Cell(60,0,'','T');
$pdf->Ln(0);
 
// PRODUCTOS
$arraycuenta2=array_count_values($_SESSION['Libroscomprar']);
$selectquery2="SELECT * FROM `libro_venta`";
$resultado2= mysqli_query($mysqli_link, $selectquery2);
while($fila2=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
	foreach ($_SESSION['Libroscomprar'] as $key => $ID) {
		if($ID==$fila2['ID']){
		foreach ($arraycuenta2 as $IDcuenta => $cuenta) {
			if($ID==$fila2['ID'] && $IDcuenta==$fila2['ID']){
				$pdf->SetFont('Helvetica', '', 7);
				$pdf->MultiCell(30,4,utf8_decode($fila2['titulo']),0,'L'); 
				$pdf->Cell(35, -5, $cuenta,0,0,'R');
				$pdf->Cell(10, -5, number_format(round($fila2['precio']), 2, ',', ' ').EURO,0,0,'R');
				$pdf->Cell(15, -5, number_format(round($cuenta*$fila2['precio']), 2, ',', ' ').EURO,0,0,'R');
				$pdf->Ln(3);
				$numero=number_format(round($cuenta*$fila2['precio']), 2, ',', ' ');
				for ($i=0; $i <count($arraycuenta2) ; $i++) { 
					$totalpreciocomprar[$i]=$numero;
				}
				}
			}
			break;
		}
	}
}
}

if((count($totalprecioalquilar)!=0)&&(count($totalpreciocomprar)!=0)){
 $total=array_sum($totalprecioalquilar)+array_sum($totalpreciocomprar);
}
elseif(count($totalpreciocomprar)!=0){
$total=array_sum($totalpreciocomprar);

}
elseif(count($totalprecioalquilar)!=0){

$total=array_sum($totalprecioalquilar);
}
// SUMATORIO DE LOS PRODUCTOS Y EL IVA
$pdf->Ln(6);
$pdf->Cell(60,0,'','T');
$pdf->Ln(2);    
$pdf->Cell(25, 10, 'TOTAL SIN I.V.A.', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round((round($total,2)/1.21),2), 2, ',', ' ').EURO,0,0,'R');
$pdf->Ln(3);    
$pdf->Cell(25, 10, 'I.V.A. 21%', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round((round($total,2)),2)-round((round(2*3,2)/1.21),2), 2, ',', ' ').EURO,0,0,'R');
$pdf->Ln(3);    
$pdf->Cell(25, 10, 'TOTAL', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(15, 10, number_format(round($total,2), 2, ',', ' ').EURO,0,0,'R');
 
// PIE DE PAGINA
 
$pdf->Output($usuario.'ticket.pdf','i');
$_SESSION['Compralibro']=array();
}


?>

<!DOCTYPE html>
<html>
<head>
	<script>
    		if (window.history.replaceState) { // verificamos disponibilidad
   			 window.history.replaceState(null, null, window.location.href);
		}

    	</script>
  	<center>
    <meta charset="utf-8">
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
    height:1000px;
		width:1000px;
      }
      #contenedor {
        margin:10 auto;
        height:20px;
        padding:10px;
        width:900px;
      }
      #contenedor2{
           margin:10 auto;
        height:300px;
        padding:10px;
        width:900px;
      }
      #Izquierda_boton {
        float:left;
        height:20px;
        padding:0px;
        width:300px;
      }

      #centro_info{
        float:left;
        height:20px;
        padding:0px;
        width:300px;



      }

    
      #Derecha_boton {
        float:left;
        height:20px;
        padding:0px;
        width:300px;
      }

      #Izquierda {
        float:left;
        height:300px;
        padding:0px;
        width:300px;
      }

      #centro{
        float:left;
        height:300px;
        padding:0px;
        width:300px;



      }

    
      #Derecha {
        float:left;
        height:300px;
        padding:0px;
        width:300px;
      }
  	</style>
	<title></title>
</center>
</head>
<body>
	<center>

	<div id="grancontenedor">
<div id="contenedor2">
  	<?php
              echo '<p class="usuario">'.'Gracias por comprar en nuestra Tienda '.$usuario.'!!'.'</p>';
              echo '<p class="usuario">'.'Has Comprado:'.count($_SESSION['Libroscomprar']).' Libros !! '.'Los alquilados estan en el apartado de alquilados'.'</p>';
           
						?>
    		<form method="post">
			  <input type="submit" name="Volver_inicio" value="Volver Inicio">
			  <input type="submit" name="Sacar_Tikect" value="Sacar Tikect">
			   				</form>
					<?php
					if (isset($_POST['Volver_inicio'])) {
						$_SESSION['Compralibro']=array();
						header('Location:s/paginasproyecto/PaginaPrincipal.php');
						}


					?>

</div>

</div>
</center>

</body>
</html>