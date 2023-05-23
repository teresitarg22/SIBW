<?php
    require "padre.php";

    $resultado = $mysqli->query("SELECT id, nombre FROM cientificos");
    $cientifico = array();

    if($resultado->num_rows > 0){
        while($fila = $resultado->fetch_assoc()){
            $cient = array('id' => $fila['id'], 'nombre' => $fila['nombre']);

            // Obtenemos la primera foto de la galería del científico:
            $fotos = getGaleria($fila['id']);
            
            if (!empty($fotos)) {
                $primera_foto = $fotos[0];
                $cient['foto'] = $primera_foto['foto'];
            }

            array_push($cientifico, $cient);
        }
    }

    if($usuario === "")
        echo $twig->render('portada.html', ['cientifico' => $cientifico, 'isLogged' => false]);
    else
        echo $twig->render('portada.html', ['cientifico' => $cientifico, 'usuario' => $usuario, 'isLogged' => true]);

?>
