<?php
    require "../Vista/padre.php";
    
    $data = json_decode(file_get_contents("php://input"), true);
    $idComentario = $data["id_comentario"];
    $comentario = $data["nuevo_comentario"];

    // Actualizar los datos del comentario en la base de datos
    $actualizado = updateComentario($idComentario, $comentario);

    // Comprobar si la actualización fue exitosa
    if ($actualizado) {
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos.";
    }

    // $idCientifico = $_GET['cientifico'];
    // $cientifico = getCientifico($idCientifico);
    // echo $twig->render('cientifico.html', ['cientifico' => $cientifico, 'usuario' => $usuario, 'isLogged' => true]);
?>