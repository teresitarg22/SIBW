<?php
    require "../Vista/padre.php";

    $idCientifico = $_GET['cientifico'];
    
    // Verificamos si se envió el formulario y se procesan los datos.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $biografia = $_POST['biografia'];
        $frases = $_POST['frases'];
        
        // Actualizar los datos del usuario en la base de datos
        $actualizado = updateCientifico($idCientifico, $nombre, $fecha, $biografia, $frases);
        
        // Comprobar si la actualización fue exitosa
        if ($actualizado) {
            echo "Datos actualizados correctamente.";
        } else {
            echo "Error al actualizar los datos.";
        }
    }

    $cientifico = getCientifico($idCientifico);
    echo $twig->render('configurar_cientifico.html', ['cientifico' => $cientifico, 'usuario' => $usuario, 'isLogged' => true]);
?>
