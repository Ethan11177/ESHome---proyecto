<?php

    session_start();

    if (!isset($_SESSION["correo"])) {
        header("location: ./../index.html");
    }else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESHome</title>
    <link rel="stylesheet" href="..\..\CSS\index.css">
    <link rel="stylesheet" href="..\..\CSS\informacion-departamento.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <script src="./../../JS/jquery_3.6.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

    $(document).ready(()=>{
        $("form#formUpload").submit((e)=>{
                e.preventDefault();
                var formData = new FormData($("form")[0]);
                $.ajax({
                    method:"post",
                    url:"./../../Back-end/Uploads/upload.php",
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData:false,
                    success:function(respAX){

                        let AX = JSON.parse(respAX);
                        let fecha = new Date();

                        if(AX.cod == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ESHOME - ' + fecha.getDate() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getFullYear(),
                                text: AX.msj,
                                confirmButtonText: 'OK',
                                didDestroy:()=>{
                                    window.location.href = "./../../Back-end/index_sesion_iniciada.php"
                                }
                            })
                        }
                        else{
                            Swal.fire({
                                icon: 'error',
                                title: 'ESHOME - ' + fecha.getDate() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getFullYear(),
                                text: AX.msj,
                                confirmButtonText: 'OK'
                            })
                        }
                }
            });
        });
    });

    </script> 
</head>
<body>
    <header>
    <a href="..\index.html" class="logo">
        <img src="..\..\Imagenes\Logo.jpeg" alt="Logo">
        <h2>ESHome</h2>
    </a>
    <nav>
        <a href="..\inicio.html" class="nav-link">Sesión</a>
    </nav>
    </header>
    <div class="centro">
        <div class="formulario">
            <h3 class="titulo">!Ingresa los datos para que las <br>personas vean lo grandioso que es!</h3>
            <form id="formUpload">
                <label for="nombre">Ingresa el nombre del Arrendador</label><br>
                <input type="text" id="nombre" name="nombre"><br>

                <label for="ubicacion">Ingresa la ubicación del departamento</label><br>
                <input type="text" id="calle" name="calle" placeholder="Calle"><br>
                <input type="text" id="noint" name="noint" placeholder="Numero Interior"><br>
                <input type="text" id="noext" name="noext" placeholder="Numero Exterior"><br>
                <input type="text" id="colonia" name="colonia" placeholder="Colonia"><br>
                <input type="text" id="delegacion" name="delegacion" placeholder="Delegacion"><br>

                <label for="precio">Precio</label><br>
                <input type="number" id="precio" name="precio"><br>

                <label for="especificaciones">Descripcion</label><br>
                <textarea name="descripcion" id="descripcion" cols="38" rows="5"></textarea><br>
                
                <label for="fotos">Sube algunas fotos</label><br>
                <input type="file" id="archivo" name="archivo" accept="application/jpg">
                <br>
                <br>
                <input type="submit" class="submit" value="Dar de alta mi departamento">
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <footer>
        <div class="footer">
            <div class="i">Todos los derechos reservados Equipo 6 2022</div>
        </div>
    </footer>
</body>
</html>

<?php

    }

?>