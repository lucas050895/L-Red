<?php
    /*GUARDA CADA VALOR INGRESADO EN EL FORMULARIO EN CADA VARIABLE*/
    $destinatario = "stlucasconde@gmail.com";
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $celular = $_POST["celular"];
    $mensaje = $_POST["mensaje"];

    $contenido = "Nombre: " . $nombre . "\nCorreo: " . $correo ."\nCelular: " . $celular .  "\nMensaje: " . $mensaje ."\n\nEste mensaje fue enviado desde el sitio web.";

    mail($destinatario,"Mensaje del Sitio Web", $contenido, "From: $correo");

    /*REDIRECCIONA A LA PAGINA DE INICIO*/
    header("Location: ../index.php")
?>