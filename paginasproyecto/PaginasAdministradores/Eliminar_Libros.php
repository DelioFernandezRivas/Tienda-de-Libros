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
              <!--<input type="submit" name="Mostrar" value="Mostrar libros a Comprar/Alquilar">-->
            </form>
              <div align="right" id="Sesion">
            <?php
              echo '<p class="usuario">'.$usuario.'</p>';
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
              ?>

              <?php
              if (isset($_POST['Volver_inicio'])) {
                header('Location:http://localhost/dashboard/paginasproyecto/PaginasAdministradores/PaginaAdministradores.php');


}

              ?>

  </div>
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
    width:1100px;
      }
      #contenedor {
        margin:10 auto;
        height:1300px;
        padding:10px;
        width:1100px;
      }
      #contenedor2{
        margin:10 auto;
        height:1100px;
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

      #usuario{
        float:left;
        height:300px;
        padding:10px;
        width:390px;


      }
       #centro{
        float:left;
        height:100px;
        padding:0px;
        width:1000px;



      }
       #Contenido{
        float:left;
        height:350px;
        padding:10px;
        width:410px;


      }
    </style>
  
  </head>
  <body>
<center>
  <div align="center" id="grancontenedor">
     <?php 
    echo '<form method='."'post'".'>';
    // action='."'Admitir_usuarios_cojer_datos.php'".'

    ?>
  <div id ="contenedor">
  <div align="center" id="Izquierda">
      <p>Libros en Alquiler</p>
      <?php
      if(!isset($_GET['page']))
      {

        $idcontadorpaginas=1;
      }
      else{
      $idcontadorpaginas=$_GET['page'];
    }
      //echo $idcontadorpaginas;
      $selectquery="SELECT * FROM `libro_para_alquilar` WHERE pagina_web='$idcontadorpaginas'";
      $resultado= mysqli_query($mysqli_link, $selectquery);
      //$contador=0;
     while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        $titulo=$fila['titulo'];
        $cantidade=$fila['cantidade'];
        $descripcion=$fila['descripcion'];
        $editorial=$fila['editorial'];
        $precio=$fila['precio'];
        $id=$fila['ID'];
        $imagen=$fila['foto'];
        echo'<div align="center" id="Contenido">';
        echo "<br></br>";
        echo "<img src='"."..\\".$imagen."' width='100px'>";
        echo "<p>".$id."</p>";
        echo "<p>".$titulo."</p>";
        if($cantidade==0){
          echo "<p>Sin Stock</p>";
        }
          else{
            echo "<p>"."En Stock: ".$cantidade."</p>";
          }
        echo "<p>".$editorial."</p>";
        echo "<p>".$precio."€</p>";

        echo '<input type="checkbox" name="'."libros_venta".$titulo.'" value="'.$id.'">';
        echo'</div>';
             
} 
      ?>
  </div>

  <div align="center" id="Derecha">
    <p>Libros para Compra</p>
    <?php
     if(!isset($_GET['page']))
      {

        $idcontadorpaginas=1;
      }
      else{
      $idcontadorpaginas=$_GET['page'];
    }
      //echo $idcontadorpaginas;
      $selectquery="SELECT * FROM `libro_venta` WHERE pagina_web='$idcontadorpaginas'";
      $resultado= mysqli_query($mysqli_link, $selectquery);
      //$contador=0;
     while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        $titulo=$fila['titulo'];
        $cantidade=$fila['cantidade'];
        $descripcion=$fila['descripcion'];
        $editorial=$fila['editorial'];
        $precio=$fila['precio'];
        $id=$fila['ID'];
        $imagen=$fila['foto'];
        echo'<div align="center" id="Contenido">';
        echo "<br></br>";
        echo "<img src='"."..\\".$imagen."' width='100px'>";
        echo "<p>".$id."</p>";
        echo "<p>".$titulo."</p>";
        if($cantidade==0){
          echo "<p>Sin Stock</p>";
        }
          else{
            echo "<p>"."En Stock: ".$cantidade."</p>";
          }
        echo "<p>".$editorial."</p>";
        echo "<p>".$precio."€</p>";
        echo '<input type="checkbox" name="'."libros_alquilar".$id.'" value="'.$id.'">';
      
      
        echo'</div>';
} 


    
      ?>

  </div>
</div>
<?php
echo '<div>';
echo '<input type="submit" name="Eliminar_Libros" value="Eliminar Libros">';
echo '</form>';
//$delete="DELETE libro_para_alquilar,libro_venta FROM `libro_para_alquilar` AS libro_para_alquilar JOIN `libro_venta` AS libro_venta WHERE `libro_para_alquilar.ID`='$titulo' OR `libro_venta.ID`='$titulo';";
//mysqli_query($mysqli_link,$delete);
if(isset($_POST['Eliminar_Libros'])){
  $sabernullalquilar=0;
  $sabernullcomprar=0;
    $titulosarray=$_POST;
    //print_r($_POST);
    foreach ($titulosarray as $tituloarray => $id) {
      //echo $id;
      $selectquery="SELECT libro_para_alquilar.ID AS IDalquilar,libro_venta.ID AS IDventa from libro_para_alquilar JOIN libro_venta;";
      $resultado= mysqli_query($mysqli_link, $selectquery);
      while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
        $idalquilarsql=$fila['IDalquilar'];
        $idventasql=$fila['IDventa'];
        //echo $idventasql;
        //echo "  ".$id."  ";
        //echo "  ".$idsql."  ";
        if($idalquilarsql==$id){
          //echo "  ".$id."  ";
        //print_r($fila['titulo']);
      if(!is_null($idalquilarsql)){
        $sabernullalquilar=1;
        $delete="DELETE FROM `libro_para_alquilar` WHERE ID='$idalquilarsql'";
        mysqli_query($mysqli_link,$delete);
        //echo $idalquilarsql;
      }
    }
      if($idventasql==$id){
         //echo "  ".$id."  ";
      if(!is_null($idventasql))
      {
        $sabernullcomprar=1;
        $delete="DELETE FROM `libro_venta` WHERE `ID`='$idventasql'";
        mysqli_query($mysqli_link,$delete);
         //echo $idventasql;


      }
    }
      }
      }
  




      if($sabernullalquilar==1){
      
      
               $contadorlibros=0;
               $contadorpaginas=1;
               $selectquery="SELECT * FROM `libro_para_alquilar`";
               $resultado= mysqli_query($mysqli_link, $selectquery);
                       while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                        $id=$fila['ID'];
                        if($contadorlibros==3){
                          $contadorpaginas++;
                          $contadorlibros=0;


                        }
                         $update="UPDATE `libro_para_alquilar` SET `pagina_web` = '$contadorpaginas' WHERE `ID`='$id';";
                        mysqli_query($mysqli_link,$update);
                        $contadorlibros++;
                       
                      }
                    }
                    

            if($sabernullcomprar==1){
              
            
            
               $contadorlibros2=0;
               $contadorpaginas2=1;
               $selectquery="SELECT * FROM `libro_venta`";
               $resultado= mysqli_query($mysqli_link, $selectquery);
                       while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                        $id=$fila['ID'];
                        if($contadorlibros2==3){
                          $contadorpaginas2++;
                          $contadorlibros2=0;

                        }
                        $update2="UPDATE `libro_venta` SET `pagina_web` = '$contadorpaginas2' WHERE `ID`='$id';";
                        mysqli_query($mysqli_link,$update2);
                        $contadorlibros2++;
                       
                      }
                    }
                    

   }

        
echo'</div>';






$selectquery="SELECT libro_para_alquilar.pagina_web AS pagina_webalquilar,libro_venta.pagina_web AS pagina_webventa from libro_para_alquilar RIGHT JOIN libro_venta ON libro_para_alquilar.ID=libro_venta.ID 
UNION ALL
SELECT libro_para_alquilar.pagina_web AS pagina_webalquilar,libro_venta.pagina_web AS pagina_webventa from libro_para_alquilar LEFT JOIN libro_venta ON libro_para_alquilar.ID=libro_venta.ID;";
$resultado= mysqli_query($mysqli_link, $selectquery);
$contadorpaginas=1;
$contadortotales=0;
$pagina=1;
$selectquery3="SELECT pagina_web  from libro_para_alquilar ;";
$resultado3= mysqli_query($mysqli_link, $selectquery3);
$selectquery4="SELECT pagina_web  from libro_venta ;";
$resultado4= mysqli_query($mysqli_link, $selectquery4);
$filas2=mysqli_num_rows($resultado3);
$filas3=mysqli_num_rows($resultado4);
//echo $filas;
     while($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
      $pagina_web_alquilar=$fila['pagina_webalquilar'];
      $pagina_web_venta=$fila['pagina_webventa'];
      if($filas2>$filas3){
      $saberlibrosquedan=$filas2-$contadortotales;
       //echo " ".$saberlibrosquedan." ";
      //echo " ".$contadortotales." ";
      //echo $pagina_web_alquilar;
      if($saberlibrosquedan==1){
          $href = 'Eliminar_Libros.php?page='.$pagina.'';
          echo '<button type=button onclick="window.location.href='."'".$href."'".'">'.$pagina."</button>";
          $pagina++;
          $contadortotales=0;
          $contadorpaginas=0;
      }
      if($contadorpaginas==3){
          $href = 'Eliminar_Libros.php?page='.$pagina.'';
          echo '<button type=button onclick="window.location.href='."'".$href."'".'">'.$pagina."</button>";
          $pagina++;
          $contadorpaginas=0;
        }
        if(!is_null($pagina_web_alquilar)){
          $contadorpaginas++;
          $contadortotales++;
        }
     }
     else{
      $saberlibrosquedan=$filas3-$contadortotales;
      if($saberlibrosquedan==1){
          $href = 'Eliminar_Libros.php?page='.$pagina.'';
          echo '<button type=button onclick="window.location.href='."'".$href."'".'">'.$pagina."</button>";
          $pagina++;
          $contadortotales=0;
          $contadorpaginas=0;
      }
      if($contadorpaginas==3){
          $href = 'Eliminar_Libros.php?page='.$pagina.'';
          echo '<button type=button onclick="window.location.href='."'".$href."'".'">'.$pagina."</button>";
          $pagina++;
          $contadorpaginas=0;
        }
          if(!is_null($pagina_web_venta)){
          $contadorpaginas++;
          $contadortotales++;
        }



     }
}

     
  ?>
</div>
  </center>
  </body>
</html>
<?php

mysqli_close($mysqli_link);
?>