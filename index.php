<?php
session_start(); 
$establoqueado=0;
if(!isset($_SESSION['verifica'])){
	$_SESSION["verifica"] = 1; 
	}
if(!isset($_SESSION['intentos'])){

	$_SESSION['intentos']=0;
	}

if(!isset($_SESSION['intentosclientes'])){


	$_SESSION['intentosclientes']=0;
}

if(!isset($_SESSION['captchaOK'])){

$_SESSION['captchaOK']=0;
$captchaOK=$_SESSION['captchaOK'];

}
$captchaOK=0;
$verifica =$_SESSION["verifica"] ; 

include 'Conexion.php';
if(mysqli_connect_errno())
{
  printf("MySQL connection failed with the error: %s", mysqli_connect_error());
  exit;
}

if ($_SESSION['intentosclientes']==5) {
    	$_SESSION['intentosclientes']=1;
 }


if ($_SESSION["verifica"] == 1 ||$_SESSION['intentos'] >1 || $_SESSION['intentosclientes']>1)  
{  

if (isset($_POST['Enviar'])) { 
$verifica=1;
$usuario = $_POST['Usuario'];
$contraseña = $_POST['Contraseña'];
$usuarioOK=0;
$contraseñaOK=0;
$saberadmin=1;
$sabernull=0;
$message="";
$message2="";
$boton="";
$intentos=0;
$saberbloqueado=0;

$selectquery="SELECT * FROM `usuario`";
$selectquery2="SELECT * FROM `usuario` WHERE usuario='$usuario'";
$resultado= mysqli_query($mysqli_link, $selectquery);
$resultado2=mysqli_query($mysqli_link, $selectquery2);

while(mysqli_fetch_array($resultado, MYSQLI_ASSOC)==NULL){

	$sabernull=1;
	break;
}
if($sabernull==0){
	while($fila=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
		if(isset($_SESSION['intentosclientes'])){
		if($fila['usuario']==$usuario && $fila['tipo_usuario']!=$saberadmin){ 
				$usuarioOK=1;
				if($fila['contraseña']==$contraseña && $usuarioOK==1){
				    	$contraseñaOK=1;
				    	break;
			 }
		}
	}
if(isset($_SESSION['intentos'])){
		if($fila['usuario']==$usuario && $fila['tipo_usuario']==$saberadmin && $fila['limite_inicios_sesion']==0){
				$usuarioOK=1;
				$saberadmin=2;
			   if($fila['contraseña']==$contraseña && $usuarioOK==1 && $saberadmin==2){
					   $contraseñaOK=1;
					   break;
			}
		}
		if($fila['usuario']==$usuario && $fila['tipo_usuario']==$saberadmin && $fila['limite_inicios_sesion']==1){
			$establoqueado=$fila['limite_inicios_sesion'];
			break;
		}
		}				
	}
}

if(($usuarioOK==0) || ($sabernull==1)){
	$selectquery="SELECT * FROM `novo_rexistro` WHERE usuario='$usuario'";
	$resultado= mysqli_query($mysqli_link, $selectquery);
	$resultado2= mysqli_query($mysqli_link, $selectquery);
	if(is_null(mysqli_fetch_array($resultado, MYSQLI_ASSOC))){
		$message="Quiere crear una cuenta? pulse en el siguiente enlace";
	$boton='<button onclick="document.location='."'"."paginasproyecto/crear_cuenta".".php'".";".'">'."Crea una Cuenta"."</button>";

	}

	else{
		while($fila=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
			$usuarionuevo=$fila['usuario'];
			if($usuarionuevo==$usuario){
				$message="Esperando para Validación";


			}

		}


	}

}

if(($usuarioOK==1 && $contraseñaOK==0)){
	if($saberadmin!=2){
		++$_SESSION['intentosclientes'];
	}
	if($saberadmin==2){
		++$_SESSION['intentos'];
		$intentos=$_SESSION['intentos'];
		if($intentos==3){
			$saberbloqueado=1;
			$saberbloqueadoquery="UPDATE `usuario` SET limite_inicios_sesion='$saberbloqueado' WHERE usuario='$usuario'";
			mysqli_query($mysqli_link, $saberbloqueadoquery); 
			$message="Se ha intentado 3 veces a administrador, bloqueado";
			session_destroy();
		}
		if($intentos>4){


			echo "<META HTTP-EQUIV='Refresh' CONTENT='0; url=index.php'>"; 
		}

	}
	if($saberadmin==1){

	$message="Contraseña incorrecta o usuario incorrectos. Contacte con el administrador si no recuerda su contraseña o usuario";
}
}
if((($usuarioOK==1 && $contraseñaOK==1) && ($saberadmin!=2))){
	session_start();
	$_SESSION['usuario'] = $usuario;
	header('Location:http://localhost/dashboard/paginasproyecto/PaginaPrincipal.php');
 

}
if($establoqueado==1){
$message="Usuario Admin Bloqueado";


}
elseif(($usuarioOK==1 && $contraseñaOK==1) && ($saberadmin==2)){
session_start();
$_SESSION['usuario'] = $usuario;
header('Location:http://localhost/dashboard/paginasproyecto/PaginasAdministradores/PaginaAdministradores.php');


}
mysqli_close($mysqli_link);  

}
if(isset($_POST['Conectar'])){

	++$_SESSION['intentosclientes'];



}
}
else
{
echo "<META HTTP-EQUIV='Refresh' CONTENT='0; url=index.php'>"; 
}
?>
<html lang="en" dir="ltr">
<center>
  <head>
    <h1> Inicio Sesión</h1>
       <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
  <body>
    <meta charset="utf-8">
    <?php 
    	$mensaje1="Quiere crear una cuenta? pulse en el siguiente enlace";
    	$mensaje2="Contraseña incorrecta o usuario incorrectos. Contacte con el administrador si no recuerda su contraseña o usuario";
    	$mensaje3="Se ha intentado 3 veces a administrador, bloqueado";
    	$mensaje4="Usuario Admin Bloqueado";
    	$mensaje5="Pulsa el captcha Por favor";
    	$mensaje6="Esperando para Validación";
	    if ((!empty($message))&&($message==$mensaje2)) 
	    {
	      echo "<p>".$message."</p>";
	      $boton=NULL;
	    }

	    if((!empty($message))&&($message==$mensaje1)){
			echo "<p>".$message."</p>";
	    	echo $boton;

	    }
	    if ((!empty($message))&&($message==$mensaje3)) 
	    {
	      echo "<p>".$message."</p>";
	
	      $boton=NULL;
	    }
	    if((!empty($message))&&($message==$mensaje4)){
		  echo "<p>".$message."</p>";

		  $boton=NULL;
	    }

	    if((!empty($message))&&($message==$mensaje5)){
	    		echo "<p>".$message."</p>";
	    		$boton=NULL;


	    }
	      if((!empty($message))&&($message==$mensaje6)){
	    		echo "<p>".$message."</p>";
	    		$boton=NULL;


	    }
    ?>
    <form method="post">
    	<script>
    		if (window.history.replaceState) {
    			let currentState = history.state;
   			 window.history.replaceState(currentState, null, window.location.href);
		}

    	</script>
    <table>
    	<?php
    	if(isset($_POST["g-recaptcha-response"])){
			if ($_SESSION['intentosclientes']==4&&$establoqueado==0) {
					$response = $_POST["g-recaptcha-response"];
						if(!empty($response))
						{
						    $secret = "6Lfro0IaAAAAAGvsOgsaLzHsnejrKyaKfJa3Oqgz";
						    $ip = $_SERVER['REMOTE_ADDR'];
						    $respuestaValidación = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$ip");
						 
						    //Si queremos visualizar la información obtenida de la petición a la api de validación de Google para comprobar el estado de esta lo haremos con la función de PHP var_dump
						 
						    $jsonResponde = json_decode($respuestaValidación);
						    if($jsonResponde->success)
						    {
						    	$_SESSION['captchaOK']=1;
						    	$captchaOK=$_SESSION['captchaOK'];
							//entrará aquí cuando todo sea correcto
						    }
						    else
						    {
						        //Google ha detectado que se trata de un proceso no humano
							//header("location:index.php?mensaje=humanCaptcha");
						    	$_SESSION['captchaOK']=2;
						    	$captchaOK=$_SESSION['captchaOK'];
						    }
						}
						else
						{
							$_SESSION['captchaOK']=3;
							
							$captchaOK=$_SESSION['captchaOK'];
							$_SESSION['intentosclientes']=3;
							$message="Pulsa el captcha Por favor";
							echo "<p>".$message."</p>";
						    //si entra aquí significa que no se ha pulsado el Captcha
						
						}
					}
		}
		
    	?>
      <tr>
      	<?php 
      	if($_SESSION['intentosclientes']<3){
	      	echo '<td><p>Usuario</p></td>';
	        echo '<td><p>Contraseña</p></td>';


	    }
	    elseif($_SESSION['intentosclientes']>3){
			echo '<td><p>Usuario</p></td>';
	        echo '<td><p>Contraseña</p></td>';


	    }
      	?>
      </tr>
      <tr>
      	<?php 
      	if($_SESSION['intentosclientes']<3){
	      	echo '<td><input type="text" name="Usuario" required value=""></td>';
	        echo '<td><input type="password" name="Contraseña" required value=""></td>';


	    }
	    elseif($_SESSION['intentosclientes']>3){
			echo '<td><input type="text" name="Usuario" required value=""></td>';
	        echo '<td><input type="password" name="Contraseña" required value=""></td>';


	    }
      	?>
      </tr>
    </table>
    <?php
    	if($_SESSION['intentosclientes']<3){
    		$input='<input type="submit" name="Enviar" value="Conectar">';
    		echo $input;
    	}
    	elseif($_SESSION['intentosclientes']==3){
    		$input='<input type="submit" name="Conectar" value="Enviar Captcha">';
    		echo $input;
    	}
    	elseif($_SESSION['intentosclientes']>3){
    		$input='<input type="submit" name="Enviar" value="Conectar">';
    		echo $input;
    		


    	}
    ?>
    <?php 
      	if($_SESSION['intentosclientes']<3||$_SESSION['intentosclientes']>3){
   			echo  '<input type="reset" value="Borrar información">';
		}
		?>
    <?php
    	if($_SESSION['intentosclientes']==3){
    		$div= '<div class="g-recaptcha" data-sitekey="6Lfro0IaAAAAAORdQQ13bG_pusqAm__bEQu08aiK">'.'</div>';
			echo $div;
	}
	
    ?>
    </form>
    <table>
      <tr>
      	<form method="post">
        <td>
        	<?php
        	if(isset($_POST['crear_cuenta'])){
    					
    					session_destroy();
    					header('Location:http://localhost/dashboard/paginasproyecto/crear_cuenta.php');

    			}
        	?>

        	<input type="submit" name="crear_cuenta" value="Crear Cuenta">
		</form>
        </td>
      
        </tr>
      </table>
    </center>
  </body>
</center>
</html>