<?php

  session_start();

  if (!isset($_SESSION["correo"])) {
    header("location: ./../Front-end/index.html");
  }else{

    $conexion = mysqli_connect("localhost","root","","eshome");

    $curp = $_SESSION["curp"];

    $usuario = $_POST["nombre"];
    $calle = $_POST["calle"];
    $noint = $_POST["noint"];
    $noext = $_POST["noext"];
    $colonia = $_POST["colonia"];
    $delegacion = $_POST["delegacion"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];

    $respAX = [];
    $i = 0;

    $sqlCheck = "INSERT INTO inmueble(`Nombre`,`Calle`,`NoInterior`,`NoExterior`,`Colonia`,`Descripcion`,`Delegacion`,`Disponibilidad`,`CURP`,`Renta`) VALUES('$usuario','$calle','$noint','$noext','$colonia','$delegacion','$descripcion',1,'$curp','$precio');";
    
    if (mysqli_query($conexion, $sqlCheck)) {

      if(isset($_FILES["archivo"])){

        if($_FILES["archivo"]["size"] > 0){
          
          $sqlCheckId = "SELECT `IdInmueble` FROM inmueble";
          $res = mysqli_query($conexion, $sqlCheckId);

          while($res2[$i] = mysqli_fetch_row($res)){
            $i++;
          }

          $num = mysqli_num_rows($res);
          $res3 = $res2[$num];

          $dirDestino = "./../Uploads";
          $archDestino = "$num"."-"."$curp".".jpg";

          if($_FILES["archivo"]["size"] > 5048576) {

            $respAX["cod"] = 2;
            $respAX["msj"] = "Error en el archivo. No se permiten archivos de m&aacute;s de 1M. Favor de intentarlo nuevamente.";
            
          }else{

            if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $archDestino)){

              $respAX["cod"] = 1;
              $respAX["msj"] = "El archivo se guardo correctamente en el servidor";

            }else{

              $respAX["cod"] = 0;
              $respAX["msj"] = "Error no se puede subir el archivo";

            }
          }
        }
      }else{

        $respAX["cod"] = 0;
        $respAX["msj"] = "Error";

      }

      echo json_encode($respAX);

    }

  }
?>