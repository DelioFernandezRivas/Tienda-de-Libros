<?php
session_start(); 

if(!isset($_SESSION['usuario'])){
  session_destroy();
  header('Location:http://localhost/dashboard/index.php');
	}
	if(isset($_SESSION['usuario'])){
	$usuario=$_SESSION['usuario'];
}

 if(!isset($_SESSION['Compralibro'])){

  $_SESSION['Compralibro']=array();
  $listaproductos=array();
  }
  if(!isset($_SESSION['Cantidadlibros'])){

  $_SESSION['Cantidadlibros']=0;
  $listaproductos=array();
  }
  if(isset($_SESSION['Cantidadlibros'])){
    if(count($_SESSION['Compralibro'])!=NULL){
    $_SESSION['Cantidadlibros']=count($_SESSION['Compralibro']);
    $listaproductos=$_SESSION['Compralibro'];
  }
  else{
    $_SESSION['Cantidadlibros']=0;
    $listaproductos=array();
  }
    //print_r($_SESSION['Cantidadlibros']);
  }
  /* $usuario=NULL;
   $Libros=array();
    $sesiones = 14;
  settype($var, 'boolean');
   $sesiones= settype('$_SESSION', object);
   $count=str_replace('"','','count($_SESSION');
   $finalcount=str_replace('"','',')');
   $cantidadlibros=$_SESSION['Cantidadlibros'];
  function comprobarSesion($variablesesion,$tipovariable,$variablecojer,$funcionesextra,$finalfuncionextra)
{
    
      if(!isset($_SESSION[$variablesesion])){

        $_SESSION[$variablesesion]=$tipovariable;
        }
        if(isset($_SESSION[$variablesesion])){
        $variablecojer=$funcionesextra.[$variablesesion].$finalfuncionextra;
      }
}*/
$mysqli_link= mysqli_connect("localhost", "root", "", "viviroutrasvidas");
			if(mysqli_connect_errno())
			{
			  printf("MySQL connection failed with the error: %s", mysqli_connect_error());
			  exit;
			}
     //comprobarSesion('usuario','ERROR',$usuario,addslashes($sesiones),NULL);
      //comprobarSesion('Compralibro',array(0),$Libros,$sesiones,NULL);
      //comprobarSesion('Cantidadlibros','0',$cantidadlibros,$count,$finalcount);
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
    			    <input type="submit" name="Comprar/Alquilar" value="Comprar/Alquilar">
            </form>
              <form method="post">
                <input type="submit" name="cancelar" value="Cancelar Pedido">
              </form>

              <?php
                if(isset($_POST['cancelar'])){
                    unset($_SESSION['Compralibro']);
                    header('Location:http://localhost/dashboard/paginasproyecto/PaginaComprar_Alquilar.php');
                  }
              ?>
    			    <div align="right" id="Sesion">
						<?php
              $validaralquilar=0;
              $validarvender=0;
              $erroralquilar=0;
              $errorvender=0;
              $compraralgo=0;
							echo '<p class="usuario">'.$usuario.'</p>';
              echo '<p class="usuario">'.'Libros comprados o para alquilar '.$_SESSION['Cantidadlibros'].'</p>';
             //print_r($_SESSION['Compralibro']);
						?>
					  	<form method="post">
					    				<input text-align: center type="submit" name="volver_paginaprincipal" value="Salir Sesión">
					   				</form>
							<?php
							if (isset($_POST['volver_paginaprincipal'])) {
								session_destroy();
								header('Location:http://localhost/dashboard/index.php');
						}

							if (isset($_POST['Volver_inicio'])) {
								header('Location:http://localhost/dashboard/paginasproyecto/PaginaPrincipal.php');


								}
               
                  if (isset($_POST['Comprar/Alquilar'])&&($_SESSION['Librosalquilar']!=NULL||$_SESSION['Libroscomprar']!=NULL)) {
                        if($_SESSION['Librosalquilar']!=NULL){
                         
                           $selectquery="SELECT * FROM `libro_para_alquilar`";
                           $resultado= mysqli_query($mysqli_link, $selectquery);
                           $cuentaalquilar=array_count_values($_SESSION['Librosalquilar']);
                           $contadorlibros=0;
                           $selectquery2="SELECT * FROM `libro_alquilado3` where `usuario`='$usuario'";
                           $resultado2= mysqli_query($mysqli_link, $selectquery2);
                           if(mysqli_num_rows($resultado2)!=0){
                            $numeros=array();
                           while($fila2=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
                            array_push($numeros, $fila2['pagina_web']);
                           }
                           $contadornumeropagina=array_count_values($numeros);
                           $numeromayor=max(array($contadornumeropagina));
                           //print_r($numeromayor);
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
                           while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                            foreach ($cuentaalquilar as $ID => $cuenta) {
                              $contar=0;
                              if(($fila['cantidade']>$cuenta || $fila['cantidade']==$cuenta) && $fila['ID']==$ID){
                                  $selectquery2="SELECT * FROM `libro_alquilado3`";
                                  $resultado2= mysqli_query($mysqli_link, $selectquery2);
                                  $selectquery3="SELECT * FROM `libro_alquilado3`";
                                  $resultado3= mysqli_query($mysqli_link, $selectquery3);
                                  if(is_null(mysqli_fetch_array($resultado2, MYSQLI_ASSOC))){
                                        $titulo=$fila['titulo'];
                                        $cantidade=$cuenta;
                                        $descripcion=$fila['descripcion'];
                                        $editorial=$fila['editorial'];
                                        $foto=$fila['foto'];
                                        $fotostr=str_replace("\\", "\\\\",$foto);
                                        $libro=$fila['libro'];
                                        $librostr=str_replace("\\", "\\\\",$libro);
                                        $insert="INSERT INTO `libro_alquilado3`(`ID`,`titulo`,`cantidade`,`descripcion`,`editorial`,`foto`,`libro`,`usuario`,`pagina_web`) VALUES('$ID','$titulo','$cantidade','$descripcion','$editorial','$fotostr','$librostr','$usuario',$contadorpaginas);";
                                        mysqli_query($mysqli_link, $insert);
                                        $update="UPDATE `libro_para_alquilar` SET `cantidade` = cantidade-$cuenta WHERE `ID`='$ID';";
                                        mysqli_query($mysqli_link,$update);
                                        $contadorlibros++;
                                        echo "entra";
                                        $validaralquilar=1;
                                       

                                        }
                                        elseif(!is_null(mysqli_fetch_array($resultado3, MYSQLI_ASSOC))){
                                          $selectquery4="SELECT * FROM `libro_alquilado3`;";
                                          $resultado4= mysqli_query($mysqli_link, $selectquery4);
                                          while($fila2=mysqli_fetch_array($resultado4, MYSQLI_ASSOC)){
                                            //$contadorupdate=0;
                                          if($fila2['ID']==$fila['ID'] && $fila2['usuario'] == $usuario){
                                           $idfila=$fila2['ID'];
                                           $update2="UPDATE `libro_alquilado3` SET `cantidade` = cantidade+$cuenta WHERE `ID`='$idfila' AND `usuario`='$usuario';";
                                           mysqli_query($mysqli_link,$update2);
                                             if($fila['ID']==$idfila){
                                           $update="UPDATE `libro_para_alquilar` SET `cantidade` = cantidade-$cuenta WHERE `ID`='$idfila';";
                                           mysqli_query($mysqli_link,$update);
                                           
                                         }
                                           
                                            /*$contadorupdate++;
                                                   if($contadorupdate==$cuenta){
                                                    break;


                                                  }*/
                                           $validaralquilar=1;
                                            
                                         } 
                                          elseif($fila['ID']!=$fila2['ID'] && $usuario!=$fila2['usuario'] || $contadorpaginas==$fila2['pagina_web']){
                                             //echo "entra";
                                             $id=$fila['ID'];
                                             $contadorinsert=0;
                                             //&& $contadorpaginas==$fila2['pagina_web'] && $usuario!=$fila2['usuario']
                                             //echo $contadorinsert;
                                             //&& $contadorpaginas==$fila2['pagina_web']
                                             $titulo=$fila['titulo'];
                                             $cantidade=$cuenta;
                                             $cantidadsql=$fila2['cantidade'];
                                             $descripcion=$fila['descripcion'];
                                             $editorial=$fila['editorial'];
                                             $foto=$fila['foto'];
                                             $fotostr=str_replace("\\", "\\\\",$foto);
                                             $libro=$fila['libro'];
                                             $librostr=str_replace("\\", "\\\\",$libro);
                                             //echo $contadorlibros;
                                             //echo " ".$contadorinsert." ";
                                             //cho $cuenta;
                                              //echo $id;
                                              $insert="INSERT  INTO `libro_alquilado3`(`ID`,`titulo`,`cantidade`,`descripcion`,`editorial`,`foto`,`libro`,`usuario`,`pagina_web`) VALUES('$id','$titulo','$cantidade','$descripcion','$editorial','$fotostr','$librostr','$usuario',$contadorpaginas);";
                                              mysqli_query($mysqli_link,  $insert);
                                              if($id==$ID&&$contar==0){
                                              $update="UPDATE `libro_para_alquilar` SET `cantidade` = cantidade-$cuenta WHERE `ID`='$id';";   
                                             mysqli_query($mysqli_link,$update);
                                             $contar++;
                                           }
                                            
                                               while($contadorlibros==3){
                                                if($contadorlibros==3 && $contadorpaginas==$fila2['pagina_web']){
                                                  //echo "entra if";
                                                    $contadorpaginas++;
                                                    $contadorlibros=0;
                                                    //|| $fila2['pagina_web']==$contadorpaginas && $fila2['usuario']!=$usuario
                                                    //$contadorinsert++;
                                                  }

                                              /*if($cantidadsql!=1&&$cantidadsql!=0){
                                              $update2="UPDATE `libro_alquilado3` SET `cantidade` = cantidade+$cuenta WHERE `ID`='$id' AND `usuario`='$usuario';";
                                              mysqli_query($mysqli_link,$update2);
                                              }
                                              elseif($cantidadsql==0&&$cantidadsql==1){
                                                $update2="UPDATE `libro_alquilado3` SET `cantidade` = cantidade+$cuenta WHERE `ID`='$id' AND `usuario`='$usuario';";
                                              mysqli_query($mysqli_link,$update2);

                                              }*/
                                                  $contadorinsert++;
                                                  $contadorlibros++;
                                                   if($contadorinsert==$cuenta){
                                                    break;


                                                  }


                                             }
                                          
                                             
                                             $validaralquilar=1;
                                             
                                         } 
                                        //break; 
                                     }
                                    //break;
                                   }
                                  //break;
                                 }
                                  else{

                                  $erroralquilar=1;
                                }
                                //break;     
                              }
                           }
                         }
                       
                     
                       
                       
                        if($_SESSION['Libroscomprar']!=NULL){
                           $selectquery="SELECT * FROM `libro_venta`";
                           $resultado2= mysqli_query($mysqli_link, $selectquery);
                           $cuentaventa=array_count_values($_SESSION['Libroscomprar']);
                           while($fila=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
                            foreach ($cuentaventa as $ID => $cuenta) {
                              if(($fila['cantidade']>$cuenta||$fila['cantidade']==$cuenta) &&$fila['ID']==$ID){

                            
                                  ${'update'.$ID}="UPDATE `libro_venta` SET `cantidade` = cantidade-$cuenta WHERE `ID`='$ID';";

                                  mysqli_query($mysqli_link, ${'update'.$ID});
                                  $validarvender=1;
                                }

                                else{
                                    
                                  $errorvender=1;

                                }
                           }
                         }
                       }
                     
                    }
                       if(($validaralquilar==1 && $validarvender==1)||($validaralquilar==1 || $validarvender==1)){
                          header('Location:http://localhost/dashboard/paginasproyecto/Validacion_Comprar_Alquilar.php');


                       }
                       
                       
                     

                     elseif(isset($_SESSION['Compralibro']) && (count($_SESSION['Compralibro'])==0)){
                        $compraralgo=1;

                     }




                     

                

							?>

	       </div>
       </form>
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
        height:600px;
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
       #Imagenes{
        float:left;
        height:300px;
        padding:10px;
        width:390px;


      }
      #Contenido{
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
      echo '<div align="center" id="grancontenedor">';
      if($erroralquilar==1&&$errorvender==1){

        echo "<p>"."Alquila o compra menos libros"."</p>";
        $_SESSION['Compraralgo']=0;

      }
      elseif($erroralquilar== 1){
         echo "<p>"."Alquila menos libros"."</p>";
         $_SESSION['Compraralgo']=0;
      }

      elseif($errorvender==1){
          echo "<p>"."Compra menos libros"."</p>";
          $_SESSION['Compraralgo']=0;

      }

      elseif($erroralquilar==1&&$errorvender==1){

        echo "<p>"."Alquila o compra menos libros"."</p>";
        $_SESSION['Compraralgo']=0;

      }
      elseif($compraralgo==1){

        echo "<p>"."Alquila o compra un libro antes de Pagar"."</p>";

      }
      echo '</div>';
    ?>
  <div align="center" id ="contenedor">
    <?php


    ?>
  <div align="center" id="Izquierda">
  		<p>Alquilar</p>
  		<?php

       $contarlibros=0;
       $arrayalquilar=array();
      $selectquery="SELECT * FROM `libro_para_alquilar`";
      $resultado= mysqli_query($mysqli_link, $selectquery);
      while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        for($i=0;$i<count($listaproductos);$i++){
              if($listaproductos[$i]==$fila['ID']){
                $arrayalquilar[$i]=$fila['ID'];
                $contarlibros++;

              }
          }
        }
        $_SESSION['Librosalquilar']=$arrayalquilar;
       //print_r(array_count_values($arrayalquilar));
        echo "<p>"."Alquilas: ".$contarlibros." Libros"."</p>";
        $arraycuenta=array_count_values($arrayalquilar);
       //print_r($arraycuenta);
      $selectquery2="SELECT * FROM `libro_para_alquilar`";
      $resultado2= mysqli_query($mysqli_link, $selectquery2);
      while($fila=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
       foreach ($arraycuenta as $ID => $cuenta) {
        if($fila['ID']== $ID){
          $IDsaber=$fila['ID'];
           echo "<p>"."De este libro: ".$fila['titulo']." Alquilas: ".$cuenta." Libros"."</p>";
           echo '<form method='."'post'".' action='."'Reducir_Aumentarnumeroalquilar.php'".'>';
           echo '<input type="submit" name=".'.$IDsaber.'Reducir" value="Reducir Cantidad">';
           echo '<input type="submit" name=".'.$IDsaber.'Aumentar" value="Aumentar Cantidad">';
           echo '</form>';
            echo '<form method='."'post'".' action='."'Reducir_Aumentarnumeroalquilar.php'".'>';
           echo '<input type="submit" name=".'.$IDsaber.'Eliminar" value="Elimiar Producto">';
           echo '</form>';
         }
       }
     }

  		?>
  </div>

  <div align="center" id="Derecha">
  	<p>Comprar</p>
  	<?php

    $contarlibros2=0;
    $arrayventa=array();
      $selectquery2="SELECT * FROM `libro_venta`";
      $resultado2= mysqli_query($mysqli_link, $selectquery2);
      while($fila2=mysqli_fetch_array($resultado2, MYSQLI_ASSOC)){
        for($i=0;$i<count($listaproductos);$i++){
              if($listaproductos[$i]==$fila2['ID']){
                $arrayventa[$i]=$fila2['ID'];
                $contarlibros2++;

              }
          }
          }
           $_SESSION['Libroscomprar']=$arrayventa;
        echo "<p>"."Compras: ".$contarlibros2." Libros"."</p>";
      $arraycuenta2=array_count_values($arrayventa);
       //print_r($arraycuenta);
      $selectquery3="SELECT * FROM `libro_venta`";
      $resultado3= mysqli_query($mysqli_link, $selectquery3);
      while($fila=mysqli_fetch_array($resultado3, MYSQLI_ASSOC)){
       foreach ($arraycuenta2 as $ID => $cuenta) {
        if($fila['ID']== $ID){
          $IDsaber=$fila['ID'];

           echo "<p>"."De este libro: ".$fila['titulo']." Compras: ".$cuenta." Libros"."</p>";

           echo '<form method='."'post'".' action='."'Reducir_Aumentarventa.php'".'>';
           echo '<input type="submit" name=".'.$IDsaber.'Reducir" value="Reducir Cantidad">';
           echo '<input type="submit" name=".'.$IDsaber.'Aumentar" value="Aumentar Cantidad">';
           echo '</form>';
            echo '<form method='."'post'".' action='."'Reducir_Aumentarventa.php'".'>';
           echo '<input type="submit" name=".'.$IDsaber.'Eliminar" value="Elimiar Producto">';
           echo '</form>';

          /*$_SESSION['Generar']=array();
          $generar=$_SESSION['Generar'];
          for($i=0;$i<count($arraycuenta2);$i++){
            $generar[$i]= $IDsaber;

          }
          */

         //if(isset($_POST[$IDsaber.'Reducir'])){
          /*foreach ($generar as $numero => $ID1) {
           foreach ($listaproductos as $numero => $ID2) {
              if($ID1==$ID2){
                $listaproductos


              }
            }
            */
          
        }
        
       
   }
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