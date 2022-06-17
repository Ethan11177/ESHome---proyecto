<?php

    session_start();

    if (!isset($_SESSION["correo"])) {
        header("location: ./../Front-end/index.html");
    }
    else{

        session_destroy();
        header("location: ./../Front-end/index.html");

    }

?>