<?php

    session_start();
    
    $conexion = mysqli_connect("localhost","root","","eshome");

    $contrasena = $_POST["contrasena"];
    $correo = $_POST["correo"];

    $respAX["cod"] = 0;
    $respAX["msj"] = "Error";
    $respAX["url"] = "";

    if ($contrasena == "" || $correo == ""){
        $respAX["cod"] = 0;
        $respAX["msj"] = "Error Ingrese Los Campos";
        $respAX["url"] = "";
    }
    else{

        $sqlCheck = "SELECT * FROM persona WHERE Contraseña = '$contrasena' AND Correo = '$correo';";
        $res = mysqli_query($conexion,$sqlCheck);

        $datos = mysqli_fetch_row($res);

        if (mysqli_num_rows($res)==1) {

            $respAX["cod"] = 1;
            $respAX["msj"] = "Ingreso correcto. Bienvenido $datos[1]";
            $respAX["url"] = "./../Back-end/index_sesion_iniciada.php"; 
            $_SESSION["correo"] = $correo;
            $_SESSION["curp"] = $datos[0];

        }
        else {
            
            $respAX["cod"] = 0;
            $respAX["msj"] = "¡Error! CURP ya registrado en la base de datos";
            $respAX["url"] = "";

        }
    }


    echo json_encode($respAX);

?>