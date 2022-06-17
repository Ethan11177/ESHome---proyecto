<?php

    session_start();

    if (!isset($_SESSION["correo"])) {
        header("location:./../Front-end/index.html");
    }
    else {
        

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESHome</title>
    <link rel="stylesheet" href="./../CSS/index_sesion_iniciada.css">
    <script src="./../JS/jquery_3.6.js"></script>
</head>
<body>
    <header>
        <a href="" class="logo">
            <img src="..\Imagenes\Logo.jpeg" alt="Logo">
            <h2>ESHome</h2>
        </a>
        <nav>
            <a href="./../Front-end/Arrendador/mis-departamentos.php">Mis departamentos</a>
            <a href="./../Front-end/Arrendatario/mis-solicitudes.php">Mis Solicitudes</a>
            <a href="./../Front-end/landing_session.html" class="nav-link">¿Quiénes Somos?</a>
            <a href="./cerrar_sesion.php" class="nav-link">Cerrar Sesión</a>
            
        </nav>
    </header>

    <div class="centro" id="tarjetas">
        
    </div>
</body>
<footer>
    <div class="footer">
        <div class="i">Todos los derechos reservados Equipo 6 2022</div>
    </div>
</footer>
<script>
    $(document).ready(()=>{

        $.ajax({
            method:"POST",
            url:"./obtencion_datos.php",
            cache: false,
            success:(respAX)=>{            
                let AX = JSON.parse(respAX)
                console.log(AX.db[0][0])
                console.log(AX)

                var div = document.getElementById("tarjetas")

                for (let index = 0; index < AX.num; index++) {
                    
                    if (AX.curp != AX.db[index][9]) {

                        var hijo = document.createElement("div")
                        hijo.innerHTML = "<div class='departamento'><div class='imagen'><a href=./../Front-end/departamento_session_iniciada.html?info=" + AX.db[index][0] + "><img src='./Uploads/"+AX.db[index][0]+"-"+AX.db[index][9]+".jpg' alt=''></a></div><div class='informacion'><div class='ubicacion'>Ubicación: " + AX.db[index][2] + ", " + AX.db[index][5] + ", " + AX.db[index][7] + "</div><div class='precio'>$ " + AX.db[index][10] + "</div></div></div><br>"
            
                        div.appendChild(hijo)

                    }
                }

            }
        })
    })
    
</script>
</html>

<?php

    }

?>