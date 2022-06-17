<?php

    session_start();

    if (!isset($_SESSION["correo"])) {
        header("location: ./../Front-end/index.html");
    }
    else{

        $conexion = mysqli_connect("localhost","root","","eshome");

        $respAX = [];

        $nombres = $_POST["nombre"];
        $apellido_p = $_POST["apellido-p"];
        $apellido_m = $_POST["apellido-m"];
        $curp = $_POST["curp"];
        $nacimiento = $_POST["nacimiento"];
        $genero = $_POST["genero"];
        $numero = $_POST["numero"];
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];

        if ($nombres != "" || $apellido_p != "" || $apellido_m != "" || $curp != "" || $nacimiento != "" || $genero != "" || $numero != "" || $correo != "") {
            
            $sqlModifi = "UPDATE persona SET Nombre='$nombres', ApellidoP='$apellido_p', ApellidoM='$apellido_m', Sexo='$genero', FechaNacimiento='$nacimiento', Correo='$correo', Telefono='$numero', Contraseña = '$contrasena' WHERE CURP = '$curp'";
            
            if ($res = mysqli_query($conexion, $sqlModifi)) {
                $respAX["cod"] = 1;
                $respAX["msj"] = "Datos llenados de manera correcta";
                $respAX["url"] = "./../Back-end/index_sesion_iniciada.php";
            }
            else {
                $respAX["cod"] = 0;
                $respAX["msj"] = "Error llene no se pudo incertar los datos";
                $respAX["url"] = "";
            }

        }
        else{
            $respAX["cod"] = 0;
            $respAX["msj"] = "Error llene todos los datos";
            $respAX["url"] = "";
        }

        echo json_encode($respAX);
        
    }

?>