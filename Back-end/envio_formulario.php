<?php

    session_start();


    if (!isset($_SESSION["correo"])) {
        header("location:./../Front-end/index.html");
    }
    else{

        $correo = $_SESSION["correo"];
        $id_departemento = $_SESSION["id_departamento"];

        $rentado = $_POST["rentado"];
        $mascotas = $_POST["mascotas"];
        $contrato = $_POST["contrato"];
        $siguiente = $_POST["siguiente"];
        $numero = $_POST["numero"];
        $numeroNombre =$_POST["numeroNombre"];

        $respAX["cod"] = 0;
        $respAX["msj"] = "Error";
        $respAX["url"] = "";


        if ($rentado == "null" || $mascotas == "null" || $contrato == "null" || $siguiente == "null" || $numeroNombre == "" || $numero == "") {
            $respAX["cod"] = 0;
            $respAX["msj"] = "Error. Llene todos los campos";
            $respAX["url"] = "";
        }
        else {
            
            $conexion = mysqli_connect("localhost","root","","eshome");

            /////////////////////////////Llamada para el Inmueble
            $sqlCheckInmueble = "SELECT * FROM inmueble WHERE IdInmueble = '$id_departemento';";
            $resInmueble = mysqli_query($conexion,$sqlCheckInmueble);

            $filaInmueble = mysqli_fetch_row($resInmueble);

            $direccion = 'Calle: '. $filaInmueble[2]. ' Número Int. '. $filaInmueble[3]. ' Número Ext. '. $filaInmueble[4]. ' Colonia: '. $filaInmueble[5]. ' Delegación: '. $filaInmueble[7];  

            /////////////////////////////Lamada para el Arrendador
            $curp = $filaInmueble[9];

            $sqlCheckDue = "SELECT * FROM persona WHERE curp = '$curp';";
            $resDue = mysqli_query($conexion,$sqlCheckDue);

            $filaDue = mysqli_fetch_row($resDue);

            $nombre = $filaDue[1]. ' '. $filaDue[2]. ' '. $filaDue[3];

            ////////////////////////////Lamada para los datos del Arrendatario
            $sqlCheckClie = "SELECT * FROM persona WHERE correo = '$correo';";
            $resClie = mysqli_query($conexion,$sqlCheckClie);

            $filaClie = mysqli_fetch_row($resClie);

            $destinatario = $filaDue[6];
            $asunto = 'Solicitud de Arrendamiento ESHOME';
            $cuerpo = '
            <html>
                <head>
                    ESHOME. Solicitud de Arrendamiento
                </head>
                <body>
                    <h1>
                        Se tiene una solicitud de arrendamiento para el siguiente departameto. Calle: '.$filaInmueble[2].' Colonia: '.$filaInmueble[5].' NumeroInt: '.$filaInmueble[3].'
                    </h1>
                    <br>
                    <h2>
                        Solicitud de '.$filaClie[1].' '.$filaClie[2].' '.$filaClie[3].'<br>
                        Correo: '.$filaClie[6].'
                    </h2>
                    <br>
                    <h2>
                        Datos de la Encuesta
                    </h2>
                    <p>
                        ¿Alguna vez ha rentado una propiedad? Respuesta: '.$rentado.'<br>
                        ¿Tiene mascotas? Respuestas: '.$mascotas.'<br>
                        ¿Está dispuesto a cumplir con cada punto que se establece en el contrato? Respuesta: '.$contrato.'<br>
                        ¿Tiene planeado seguir viviendo en esta propiedad el siguiente año? Respuesta: '.$siguiente.'<br>
                        Número de Contacto : '.$numero.', Nombre Contacto: '.$numeroNombre.'
                    </p>
                </body>
            </html>
            ';
            
            //$headers = "MIME-Version: 1.0\r\n"; 
            //$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

            //mail($destinatario, $asunto, $cuerpo);
            
            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
            $fecha = date('Y-m-d H:i:s');
            
            $sqlCheckSoli = "INSERT INTO renta(`IdInmueble`,`CURP`,`FechaSolicitud`, `Nombre`, `Direccion`) VALUES('$id_departemento','$filaClie[0]','$fecha','$nombre','$direccion');";
            
            if (mysqli_query($conexion,$sqlCheckSoli)) {
                $respAX["cod"] = 1;
                $respAX["msj"] = "Formulario enviado de manera correcta";
                $respAX["url"] = "./../../Back-end/index_sesion_iniciada.php";
            }
            else{
                $respAX["cod"] = 0;
                $respAX["msj"] = "Ocurrió un error";
                $respAX["url"] = "";
            }

        }


        echo json_encode($respAX);

    }

?>