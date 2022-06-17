<?php

    session_start();


    if (!isset($_SESSION["correo"])) {
        header("location:./../Front-end/index.html");
    }
    else {

        $valor = $_POST["thisvalor"];

        $_SESSION['id_departamento'] = $valor;

        $conexion = mysqli_connect("localhost","root","","eshome");

        $sqlCheck = "SELECT * FROM inmueble WHERE IdInmueble = '$valor'";
        $res = mysqli_query($conexion, $sqlCheck);

        if (mysqli_num_rows($res) == 0) {
            header("location:./../Front-end/index.html");
        }else {

            $respAX["db"] = mysqli_fetch_row($res);

            $curp = $respAX["db"][9];

            $sqlCheckDue = "SELECT * FROM persona WHERE CURP = '$curp'";
            $resDue = mysqli_query($conexion, $sqlCheckDue);

            $respAX["db2"] = mysqli_fetch_row($resDue);

        }
        
        echo json_encode($respAX);  
    }   

?>