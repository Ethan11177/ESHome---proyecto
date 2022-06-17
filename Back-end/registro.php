<?php

    session_start();
    
    $conexion = mysqli_connect("localhost","root","","eshome");

    $nombre = $_POST["nombre"];
    $apellido_pa = $_POST["apellido_pa"];
    $apellido_ma = $_POST["apellido_ma"];
    $curp = $_POST["curp"];
    $contrasena = $_POST["contrasena"];
    $nacimiento = $_POST["nacimiento"];
    $genero = $_POST["genero"];
    $tel = $_POST["tel"];
    $correo = $_POST["correo"];

    $respAX["cod"] = 0;
    $respAX["msj"] = "Error";
    $respAX["url"] = "";


    if ($nombre == "" || $apellido_pa == "" || $apellido_ma == "" || $curp == "" || $contrasena == "" || $nacimiento == "" || $genero == "" || $tel == 0 || $correo == ""){
        $respAX["cod"] = 0;
        $respAX["msj"] = "Error llene todos los datos";
        $respAX["url"] = "";
    }
    else{

        $sqlCheck = "SELECT * FROM persona WHERE CURP = '$curp' OR Correo = '$correo';";
        $res = mysqli_query($conexion,$sqlCheck);

        if (mysqli_num_rows($res)==0) {
            
            $sqlReady = "INSERT INTO persona(`CURP`,`Nombre`,`ApellidoP`,`ApellidoM`,`Sexo`,`FechaNacimiento`,`Correo`,`Contraseña`,`Telefono`) VALUES('$curp','$nombre','$apellido_pa','$apellido_ma','$genero','$nacimiento','$correo','$contrasena','$tel');";
            $res = mysqli_query($conexion, $sqlReady);

            $respAX["cod"] = 1;
            $respAX["msj"] = "Ingreso de datos Correcto";
            $respAX["url"] = "./../Front-end/index.html";

        }else {
            
            $respAX["cod"] = 0;
            $respAX["msj"] = "¡Error! CURP o Correo ya Registrado";
            $respAX["url"] = "";

        }
    }


    echo json_encode($respAX);

?>