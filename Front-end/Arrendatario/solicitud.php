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
    <link rel="stylesheet" href="..\..\CSS\index.css">
    <link rel="stylesheet" href="..\..\CSS\solicitud.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./../../VALIDACION/validetta-1.0.1/src/validetta.css" type="text/css" media="screen">
    <script src="./../../JS/jquery_3.6.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="./../../VALIDACION/validetta-1.0.1/src/validetta.js"></script>
    <script type="text/javascript" src="./../../VALIDACION/validetta-1.0.1/localization/validettaLang-es-ES.js"></script>
    <script>

        $(document).ready(()=>{

            $("#formularioA").validetta()

            $("form#formularioA").submit((e)=>{
                
                e.preventDefault()

                $.ajax({
                    method:"POST",
                    url:"./../../Back-end/envio_formulario.php",
                    data:$("form#formularioA").serialize(),
                    cache: false,
                    success:(respAX)=>{

                        let AX = JSON.parse(respAX)
                        let fecha = new Date()

                        if(AX.cod == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ESHOME - ' + fecha.getDate() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getFullYear(),
                                text: AX.msj,
                                confirmButtonText: 'OK',
                                didDestroy:()=>{
                                    window.location.href = AX.url
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
                })
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
            <a href="./../../Back-end/cerrar_sesion.php" class="nav-link">Cerrar Sesión</a>
        </nav>
    </header>
    <div class="centro">
        <div class="formulario">
        <h3>¡Ya estas un paso más cerca de que el departamento sea tuyo!</h3>
            <form action="#" method="POST" name="FormularioArrendatario" id="formularioA">
                <fieldset class="bloque"><br>
                    <legend>¡Sobre ti...!</legend>
                    <label for="1">¿Alguna vez has rentado una propiedad?</label><br>
                    <select name="rentado" id="rentado" data-validetta="required">      <!-rentado para el post-!>
                        <option value="null">-</option>
                        <option value="Si">Sí</option>
                        <option value="No">No</option>
                    </select><br><br>
                    <label for="2">¿Tienes mascotas?</label><br>
                    <select name="mascotas" id="mascotas" data-validetta="required">    <!-mascotas para el post-!>
                        <option value="null">-</option>
                        <option value="Si">Sí</option>
                        <option value="No">No</option>
                    </select><br><br>
                    <label for="3">¿Estás dispuesto a cumplir con cada punto que se establece en el contrato?</label><br>
                    <select name="contrato" id="contrato" data-validetta="required">    <!-contrato para el post-!>
                        <option value="null">-</option>
                        <option value="Si">Sí</option>
                        <option value="No">No</option>
                    </select><br><br>
                    <label for="3" ><a download="Contrato" href="./../../Archivo/Contrato_de_arrendamiento _inmobiliario.pdf" id="contrato" style="color: black; text-decoration: underline;">¡Descarga el Contrato aquí!</a></label><br><br>       <!-para poder hacer la descarga del contrato-!>
                    <label for="4">¿Tienes planeado seguir viviendo en esta propiedad el siguiente año?</label><br>
                    <select name="siguiente" id="siguiente" data-validetta="required">          <!-para el siguiente-!>
                        <option value="null">-</option>
                        <option value="Si">Sí</option>
                        <option value="No">No</option>
                        <option value="Posiblemente">Posiblemente</option>
                    </select><br><br>
                </fieldset>
                <fieldset class="bloque">
                    <legend>Contacto</legend><br>
                    <label for="5">Proporciona un número de teléfono adicional</label><br>
                    <input id="numero" type="tel" name="numero" maxlength="10" placeholder="" data-validetta="required,maxLength[10],number"><br><br>   <!-para el post del numero-!>
                    <label for="5">Ingresa el nombre a quien corresponde este número</label><br>
                    <input id="numeroNombre" type="text" name="numeroNombre" maxlength="80" placeholder="Nombre(s) Apellidos" data-validetta="required,maxLength[80]"><br><br>      <!-para el post del numeroNombre post-!>
                </fieldset>
                <input class="submit" type="submit" value="Registrame">
            </form>
        </div>
        </div>
    </div>
    <footer>
        <div class="footer">
            <div class="i">Todos los derechos reservados Equipo 6 2022</div>
        </div>
    </footer>
    <br><br><br><br><br><br><br>
</body>
</html>

<?php

    }

?>