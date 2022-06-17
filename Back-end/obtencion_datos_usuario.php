<?php

    session_start();

    if (!isset($_SESSION["correo"])) {
        header("location: ./../Front-end/index.html");
    }
    else{
        
        $conexion = mysqli_connect("localhost","root","","eshome");
        $curp = $_SESSION["curp"];
        $respAX = [];

        $sqlCheck = "SELECT * FROM persona WHERE CURP = '$curp';";

        if ($res = mysqli_query($conexion,$sqlCheck)) {
            $respAX["db"] = mysqli_fetch_row($res);
            echo json_encode($respAX);
        }
        else {
            header("location: ./../Front-end/index.html");
        }
        
    }

?>