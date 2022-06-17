<?php

    session_start();

    if (!isset($_SESSION["correo"])) {
        header("location: ./../Front-end/index.html");
    }else{

        $curp = $_SESSION["curp"];
        $repsAX["num"] = 0;

        $i = 0;

        $conexion = mysqli_connect("localhost","root","","eshome");

        $sqlCheckRenta = "SELECT * FROM renta WHERE CURP = '$curp';";

        if ($resRenta = mysqli_query($conexion,$sqlCheckRenta)){
            
            $repsAX["num"] = mysqli_num_rows($resRenta);

            while ($repsAX["db"][$i] = mysqli_fetch_row($resRenta)) {
                $i++;
            }

            echo json_encode($repsAX);
        }

    }

?>