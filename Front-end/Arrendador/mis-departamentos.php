<?php

    session_start();

    if (!isset($_SESSION["correo"])) {
        header("location:./../index.html");
    }
    else {
        

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESHome</title>
    <link rel="stylesheet" href="..\..\CSS\mis-departamentos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet"> 
    <script src="./../../JS/jquery_3.6.js"></script>
    <script>

    $(document).ready(()=>{

        $.ajax({
            method:"POST",
            url:"./../../Back-end/obtencion_mis_departamentos.php",
            cache: false,
            success:(respAX)=>{         

                let AX = JSON.parse(respAX)
                console.log(AX)

                var div = document.getElementById("depas")

                for (let index = 0; index < AX.num; index++) {

                        var hijo = document.createElement("div")
                        hijo.innerHTML = "<div class='departamento'><div class='imagen'><a><img src='./../../Back-end/Uploads/"+AX.db[index][0]+"-"+AX.db[index][9]+".jpg' alt=''></a></div><div class='informacion'><div class='ubicacion'>Ubicación: " + AX.db[index][2] + ", " + AX.db[index][5] + ", " + AX.db[index][7] + "</div><div class='precio'>$" + AX.db[index][10] + "</div></div>"    
                        div.appendChild(hijo)
                }
            }
        })
    })

    </script>
</head>
<body>
    <header>
     <a href="./../../Back-end/index_sesion_iniciada.php" class="logo">
        <img src="..\..\Imagenes\Logo.jpeg" alt="Logo">
        <h2>ESHome</h2>
     </a>
    <nav>
        <a href="./../../Back-end/index_sesion_iniciada.php" class="nav-link">Regresar</a>
        <a href="./../../Back-end/cerrar_sesion.php" class="nav-link">Cerrar Sesion</a>
    </nav>
    </header>
    <div class="centro" id="depas">
        <div class="departamento">
            <div class="imagen"><a href="informacion-departamento.php"><img src="..\../Imagenes/+.png" alt=""></a></div>
            <div class="informacion">
                <div class="ubicacion">Añadir un nuevo departamento</div>
                <div class="precio"></div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer">
            <div class="i">Todos los derechos reservados Equipo 6</div>
        </div>
    </footer>
</body>
</html>

<?php

    }

?>