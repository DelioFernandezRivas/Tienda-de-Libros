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


$mysqli_link= mysqli_connect("localhost", "root", "", "viviroutrasvidas");
      if(mysqli_connect_errno())
      {
        printf("MySQL connection failed with the error: %s", mysqli_connect_error());
        exit;
      }
      $idobtenido=$_GET['ID'];
      //echo $idobtenido;
      $selectquery="SELECT * FROM `libro_alquilado3` WHERE usuario='$usuario' AND ID='$idobtenido'";
      $resultado= mysqli_query($mysqli_link, $selectquery);
      //print_r($_GET['pagina']);
     //$cuentaalquilar=array_count_values($_SESSION['Librosalquilar']);
     $contadorlibros=0;
     $selectquery2="SELECT * FROM `libro_devuelto`";
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
        //echo "Entra";
        $id=$fila['ID'];
        $titulo=$fila['titulo'];
        $cantidade=$fila['cantidade'];
        $descripcion=$fila['descripcion'];
        $editorial=$fila['editorial'];
        $foto=$fila['foto'];
        $fotostr=str_replace("\\", "\\\\",$foto);
        $libro=$fila['libro'];
        $librostr=str_replace("\\", "\\\\",$libro);
        echo $id;
        $pdf=$fila['libro'];
        $contar=$fila['cantidade'];
        if( (isset($_GET['pagina']) && $_GET['pagina']==$pdf) && ($contar>0) && ((isset($_GET['ID']) && $_GET['ID']==$id)) ){
          //echo "Entra";
          $update="UPDATE `libro_alquilado3` SET `cantidade` = cantidade-1 WHERE `ID`='$id' AND `usuario`='$usuario';";
          mysqli_query($mysqli_link,$update);
           $selectquery3="SELECT * FROM `libro_devuelto`";
          $resultado3= mysqli_query($mysqli_link, $selectquery3);
          $filas=mysqli_num_rows($resultado3);
          echo $filas;
          if($filas==0){
            $insert="INSERT  INTO `libro_devuelto`(`ID`,`titulo`,`cantidade`,`descripcion`,`editorial`,`foto`,`libro`,`usuario`,`Devolver`,`pagina_web`) VALUES('$id','$titulo','$cantidade','$descripcion','$editorial','$fotostr','$librostr','$usuario',0,$contadorpaginas);";
              mysqli_query($mysqli_link,$insert);
          }
          else{
          $selectquery="SELECT ID,pagina_web FROM `libro_devuelto`";
          $resultado= mysqli_query($mysqli_link, $selectquery);
          while ($fila2=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
            $iddevuelto=$fila2['ID'];
            if($iddevuelto!=$id){
          while($contadorlibros<=3){
              if($contadorlibros==3 && $contadorpaginas==$fila2['pagina_web']){
                //echo "entra if";
                  $contadorpaginas++;
                  $contadorlibros=0;
                  //|| $fila2['pagina_web']==$contadorpaginas && $fila2['usuario']!=$usuario
                  //$contadorinsert++;
                }
          $insert="INSERT  INTO `libro_devuelto`(`ID`,`titulo`,`cantidade`,`descripcion`,`editorial`,`foto`,`libro`,`usuario`,`Devolver`,`pagina_web`) VALUES('$id','$titulo','$cantidade','$descripcion','$editorial','$fotostr','$librostr','$usuario',0,$contadorpaginas);";
          mysqli_query($mysqli_link,$insert);
           $contadorlibros++;

         }
        }
        else{

          $update="UPDATE `libro_devuelto` SET `cantidade` = cantidade+1,`Devolver`=0 WHERE `ID`='$id' AND `usuario`='$usuario';";
          mysqli_query($mysqli_link,$update);
        }
      }
    }
          header("Content-disposition: attachment; filename=".$pdf);
          header("Content-type: MIME");
          readfile($pdf);
      }

        else{

            header('Location:http://localhost/dashboard/paginasproyecto/Ver_alquilados.php');

        }

     }


      mysqli_close($mysqli_link);
?>