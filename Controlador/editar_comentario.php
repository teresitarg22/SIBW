<?php
    require "../Vista/padre.php";

    $data = json_decode(file_get_contents("php://input"), true);
    $idComentario = $data["id_comentario"];
    $comentario = $data["nuevo_comentario"];
    
    // Actualizar los datos del comentario en la base de datos
    $actualizado = updateComentario($idComentario, $comentario);
    
    // Comprobar si la actualización fue exitosa
    if ($actualizado) {
        // Obtener el científico asociado al comentario
        $cientifico = updateComentario($idComentario, $comentario);
    
        // Redirigir a la plantilla del científico actual con el mensaje de éxito
        header("Location: ../Vista/cientifico.php?cientifico=" . $cientifico['id'] . "&mensaje=Datos actualizados correctamente.");
        exit();
    } else {
        // Redirigir a la plantilla del científico actual con el mensaje de error
        header("Location: ../Vista/cientifico.php?cientifico=" . $cientifico['id'] . "&mensaje=Error al actualizar los datos.");
        exit();
    }
?>