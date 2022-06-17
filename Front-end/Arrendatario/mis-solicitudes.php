<?php

    session_start();

    if (!isset($_SESSION["correo"])) {
        header("location: ./../index.html");
    }
    else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESHome</title>
    <link rel="stylesheet" href="..\..\CSS\index.css">
    <link rel="stylesheet" href="..\..\CSS\solicitudes.css"> <!---->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./../../VALIDACION/validetta-1.0.1/src/validetta.css" type="text/css" media="screen">
    <script src="./../../JS/jquery_3.6.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script type="text/javascript" src="./../../VALIDACION/validetta-1.0.1/src/validetta.js"></script>
    <script type="text/javascript" src="./../../VALIDACION/validetta-1.0.1/localization/validettaLang-es-ES.js"></script>
    
</head>

<body>
    <header>
        <a href="./../../Back-end/index_sesion_iniciada.php" class="logo">
            <img src="..\..\Imagenes\Logo.jpeg" alt="Logo">
            <h2>ESHome</h2>
        </a>
        <nav>
            <a href="./../../Back-end/cerrar_sesion.php" class="nav-link">Cerrar Sesión</a>
            <a href="./../../Back-end/index_sesion_iniciada.php" class="nav-link">Regresar</a>
        </nav>
    </header>
    <div class="centro">
        <div class="tabla">
            <p id="infoTabla"></p>
            <table class="solicitudes" id="tabla_datos">
            </table>
        </div>
    </div>
    <footer>
        <div class="footer">
            <div class="i">Todos los derechos reservados Equipo 6 2022</div>
        </div>
    </footer>
</body>
</html>
<?php
    $conexion = mysqli_connect("localhost","root","","eshome");
    if(!$conexion){
        die("Falló el intento de conexión a la base de datos." . mysqli_connect_error());
    }
    $consulta = "SELECT * FROM renta";
    $resultado = mysqli_query($conexion, $consulta);
    if(mysqli_num_rows($resultado) > 1){
?>
    <script>
        $(document).ready(()=>{
            $.ajax({
                method:"POST",
                url:"./../../Back-end/obtencion_datos_solicitud_arrendador.php",
                cache: false,
                success:(respAX)=>{  
                    let AX = JSON.parse(respAX);
                    console.log(AX);
                    var tabla = document.getElementById("tabla_datos");
                    tabla.innerHTML = "<tr><td>Nombre del arrendador</td><td>Dirección Departamento</td><td>Fecha de la solicitud</td></tr>";
                    for (let index = 0; index < AX.num; index++) {
                        var hijo = document.createElement("tr");
                        hijo.innerHTML = "<tr><td>"+ AX.db[index][3] +"</td><td>"+ AX.db[index][4] +"</td><td>"+ AX.db[index][2] +"</td></tr>";
                        tabla.appendChild(hijo);
                    }
                }
            })
    
        })
    </script>
<?php
    }
    else{
?>
    <script>
        document.getElementById("infoTabla").innerHTML = "Aún no se ha hecho alguna solicitud";
    </script>
<?php
    }
    
    $conexion->close();
?>
<?php

    }

?>