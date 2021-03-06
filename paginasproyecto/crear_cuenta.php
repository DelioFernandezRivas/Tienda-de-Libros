<?php
if (isset($_POST['Enviar'])) { 
$usuario = $_POST['Usuario'];
$contraseña = $_POST['Contraseña'];
$direccion = $_POST['Direccion'];
$Nifdni = $_POST['Nifdni'];
$nombre = $_POST['Nombre'];
$telefono = $_POST['Teléfono'];
include 'Conexion.php';
//$sabernull=0;
if(mysqli_connect_errno())
{
  printf("MySQL connection failed with the error: %s", mysqli_connect_error());
  exit;
}

  if($direccion==""){
  $direccion=" ";
  }
  if($Nifdni==""){
  $Nifdni=" ";
  }
  if($nombre==""){
  $nombre=" ";
  }
  if($telefono==""){
  $telefono=0;
  }

$contadorusuarios=0;
$selectquery2="SELECT * FROM `novo_rexistro`";
$resultado2= mysqli_query($mysqli_link, $selectquery2);
$contadorlibros=0;
if(mysqli_num_rows($resultado2)!=0){
        $numeros=array();
        while($fila2=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
              array_push($numeros, $fila2['pagina_web']);
              }
        $contadornumeropagina=array_count_values($numeros);
        $numeromayor=max(array($contadornumeropagina));
        $mayor=0;
        foreach ($numeromayor as $pagina => $cuenta) {
                if($cuenta==3){
                if($pagina>$mayor){
                  $mayor=$pagina;
                }
                }

        }
        $contadorpaginas=$mayor+1;

        }
else{

  $contadorpaginas=1;
}


$insertarquery="INSERT INTO `novo_rexistro`(`usuario`,`contraseña`,`nombre`,`direccion`,`telefono`,`nifdni`,`pagina_web`) VALUES('$usuario','$contraseña','$nombre','$direccion',$telefono,'$Nifdni','$contadorpaginas')";                          
$selectquery="SELECT * FROM `usuario` WHERE usuario= '$usuario';";
$selectqueryusuarionuevo="SELECT * FROM `novo_rexistro` WHERE usuario= '$usuario';";

$resultado= mysqli_query($mysqli_link, $selectquery);
$resultado2=mysqli_query($mysqli_link, $selectquery);
$resultadonuevo=mysqli_query($mysqli_link, $selectqueryusuarionuevo);
$resultadonuevo2=mysqli_query($mysqli_link, $selectqueryusuarionuevo);
//||mysqli_fetch_array($resultado, MYSQLI_ASSOC)==NULL
if(!is_null(mysqli_fetch_array($resultado, MYSQLI_ASSOC))){
    while($fila=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
        if($fila['usuario']==$usuario){
           $message="Usuario ya en uso";
           break;
        }
    }
  }

  else{
  if(is_null(mysqli_fetch_array($resultadonuevo, MYSQLI_ASSOC))){

    mysqli_query($mysqli_link, $insertarquery);
    header('Location:../index.php');


  }
  else{
    while($fila2=mysqli_fetch_array($resultadonuevo2, MYSQLI_ASSOC)){
        if($fila2['usuario']==$usuario){
           $message="Usuario en espera de confirmación de validación";
           break;
        }
    }



  }
}


mysqli_close($mysqli_link);
}
?>
<html lang="en" dir="ltr">
<center>
  <head>
    <h1>Registro</h1>
  </head>
  <body>
    <?php 
      if (!empty($message)) 
      {
        echo "<p>".$message."</p>";
      }
    ?>
    <meta charset="utf-8">
    <form action="crear_cuenta.php" method="post">
    <table>
      <tr>
        <td><p>Usuario</p></td>
        <td><input type="text" name="Usuario" required value=""></td>
      </tr>
      <tr>
        <td><p>Contraseña</p></td>
        <td><input type="password" name="Contraseña" required value=""></td>
      </tr>
      <tr>
        <td><p>Dirección</p></td>
        <td><input type="text" name="Direccion" value=""></td>
      </tr>
      <tr>
        <td><p>Nifdni</p></td>
        <td><input type="text" name="Nifdni" value=""></td>
      </tr>
      <tr>
        <td><p>Nombre</p></td>
        <td><input type="text" name="Nombre" value=""></td>
      </tr>
      <tr>
        <td><p>Teléfono</p></td>
        <td><input type="text" name="Teléfono" value=""></td>
      </tr>
    </table>
    <input type="submit" name="Enviar" value="Registrarse">
    <input type="reset" value="Borrar información">
    </form>
    <table>
      <tr>
        <td>
          <button onclick="document.location='../index.php';"> Volver</button>
        </td>
        </table>
        </body>
    </center>
</html>

