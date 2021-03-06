<?php
session_start(); 

if(!isset($_SESSION['usuario'])){

	session_destroy();
  header('Location:http://localhost/dashboard/index.php');
	}
	if(isset($_SESSION['usuario'])){
	$usuario=$_SESSION['usuario'];
}

include 'Conexion.php';
			if(mysqli_connect_errno())
			{
			  printf("MySQL connection failed with the error: %s", mysqli_connect_error());
			  exit;
			}

if (isset($_POST['Informe_Aquilar'])) {
// CONFIGURACIÓN PREVIA
$total=0;
$fecha=date("d").':'.date("m").':'.date("y");
$diamas=date("d")+15;
$fecha2=$diamas.'/'.date("m").'/'.date("y");
require('../../fpdf182/fpdf.php');
define('EURO',chr(128)); // Constante con el símbolo Euro.
$pdf = new FPDF('P','mm',array(500,335)); // Tamaño tickt 80mm x 150 mm (largo aprox)
$pdf->AddPage();
 
// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(315,4,'TiendaDelio.com',0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(315,4,'C.I.F.: 50604030L',0,1,'C');
$pdf->Cell(315,4,'C/ Pousada, 98A',0,1,'C');
$pdf->Cell(315,4,'C.P.: 36142 Vilaboa (Pontevedra)',0,1,'C');
$pdf->Cell(315,4,'999 888 777',0,1,'C');
$pdf->Cell(315,4,'deliofernandez1998@gmail.com',0,1,'C');
 
// DATOS FACTURA        

$totalprecioalquilar=array();
$totalpreciocomprar=array();
//Alquilar
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(315, 10, 'Libros Para Alquilar Informe', 0,0,'C');
$pdf->Ln(8);
$pdf->Cell(315,0,'','T');
$pdf->Ln(0);
// Columna Alquilar
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(35, 10, 'ID', 0,0,'C');
$pdf->Cell(35, 10, utf8_decode('Título'),0,0,'C');
$pdf->Cell(35, 10, 'Cantidad',0,0,'C');
$pdf->Cell(35, 10, 'Editorial',0,0,'C');
$pdf->Cell(35, 10, 'Precio',0,0,'C');
$pdf->Cell(75, 10, 'Libro',0,0,'C');
$pdf->Cell(75, 10, 'Foto',0,0,'C');
$pdf->Ln(8);
$pdf->Cell(315,0,'','T');
$pdf->Ln(0);


// PRODUCTOS
$selectquery="SELECT * FROM `libro_para_alquilar`";
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
				$pdf->SetFont('Helvetica', '', 7);
        $pdf->Cell(35, 5, utf8_decode($id),0,0,'C'); 
				$pdf->Cell(35, 5, utf8_decode($titulo),0,0,'C');
        $pdf->Cell(35, 5, $cantidade,0,0,'C');
        $pdf->Cell(35, 5, $editorial,0,0,'C');
        $pdf->Cell(35, 5, $precio.EURO,0,0,'C');
        $pdf->Cell(75, 5, $libro,0,0,'C');
        $pdf->Cell(75, 5, $imagen,0,0,'C');
				$pdf->Ln(3);
}


// SUMATORIO DE LOS PRODUCTOS Y EL IVA
// PIE DE PAGINA
$pdf->Output('ticket.pdf','i');
}


if (isset($_POST['Informe_Venta'])) {
// CONFIGURACIÓN PREVIA
$total=0;
$fecha=date("d").':'.date("m").':'.date("y");
$diamas=date("d")+15;
$fecha2=$diamas.'/'.date("m").'/'.date("y");
require('../../fpdf182/fpdf.php');
define('EURO',chr(128)); // Constante con el símbolo Euro.
$pdf = new FPDF('P','mm',array(500,335)); // Tamaño tickt 80mm x 150 mm (largo aprox)
$pdf->AddPage();
 
// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(315,4,'TiendaDelio.com',0,1,'C');
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(315,4,'C.I.F.: 50604030L',0,1,'C');
$pdf->Cell(315,4,'C/ Pousada, 98A',0,1,'C');
$pdf->Cell(315,4,'C.P.: 36142 Vilaboa (Pontevedra)',0,1,'C');
$pdf->Cell(315,4,'999 888 777',0,1,'C');
$pdf->Cell(315,4,'deliofernandez1998@gmail.com',0,1,'C');
 
// DATOS FACTURA        

$totalprecioalquilar=array();
$totalpreciocomprar=array();
//Alquilar
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(315, 10, 'Libros Para Vender Informe', 0,0,'C');
$pdf->Ln(8);
$pdf->Cell(315,0,'','T');
$pdf->Ln(0);
// Columna Alquilar
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(50, 10, 'ID', 0,0,'C');
$pdf->Cell(50, 10, utf8_decode('Título'),0,0,'C');
$pdf->Cell(50, 10, 'Cantidad',0,0,'C');
$pdf->Cell(50, 10, 'Editorial',0,0,'C');
$pdf->Cell(50, 10, 'Precio',0,0,'C');
$pdf->Cell(75, 10, 'Foto',0,0,'C');
$pdf->Ln(8);
$pdf->Cell(315,0,'','T');
$pdf->Ln(0);


// PRODUCTOS
$selectquery="SELECT * FROM `libro_venta`";
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
        $pdf->SetFont('Helvetica', '', 7);
        $pdf->Cell(50, 5, utf8_decode($id),0,0,'C'); 
        $pdf->Cell(50, 5, utf8_decode($titulo),0,0,'C');
        $pdf->Cell(50, 5, $cantidade,0,0,'C');
        $pdf->Cell(50, 5, $editorial,0,0,'C');
        $pdf->Cell(50, 5, $precio.EURO,0,0,'C');
        $pdf->Cell(75, 5, $imagen,0,0,'C');
        $pdf->Ln(3);

}


// SUMATORIO DE LOS PRODUCTOS Y EL IVA
// PIE DE PAGINA
$pdf->Output('ticket.pdf','i');
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
    <form method="post">
            <input type="submit" name="Volver_inicio" value="Volver Inicio">
            </form>
<div id="contenedor2">
  	<?php
              echo '<p class="usuario">'.'Escoje el informe a descargar '.$usuario.'</p>';
           
						?>
    		<form method="post">
			  <input type="submit" name="Informe_Venta" value="Sacar Informe libros para Venta ">
			  <input type="submit" name="Informe_Aquilar" value="Sacar Informe libros para Alquilar">
			   				</form>
           <?php
              if (isset($_POST['Volver_inicio'])) {
                header('Location:PaginaAdministradores.php');


}

              ?>

</div>

</div>
</center>

</body>
</html>
<?php

mysqli_close($mysqli_link);
?>