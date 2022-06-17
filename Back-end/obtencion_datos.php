<?php

    session_start();

    if (!isset($_SESSION["correo"])) {
        header("location:./../Front-end/index.html");
    }
    else {
        
        $respAX["num"] = 0;
        $respAX["curp"] = $_SESSION["curp"];
        
        $conexion = mysqli_connect("localhost","root","","eshome");

        $sqlCheck = "SELECT * FROM inmueble";
        $res = mysqli_query($conexion, $sqlCheck);
        
        $respAX["num"] = mysqli_num_rows($res);

        $i=0;

        while($respAX["db"][$i] = mysqli_fetch_row($res)){
            $i++;
        };
        

        echo json_encode($respAX);
        
    }

?>