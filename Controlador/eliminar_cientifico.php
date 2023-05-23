<?php
    require "../Vista/padre.php";

    $idCientifico = $_GET['cientifico'];
    
    // Eliminar los datos del científico en la base de datos, tenemos que borrar los datos de todas las tablas:
    $stmt = $mysqli->prepare("DELETE FROM galeria WHERE id_cientifico = ?");
    $stmt->bind_param("i", $idCientifico); 
    $stmt->execute();

    $stmt = $mysqli->prepare("DELETE FROM comentarios WHERE id_cientifico = ?");
    $stmt->bind_param("i", $idCientifico); 
    $stmt->execute();

    $stmt = $mysqli->prepare("DELETE FROM enlaces WHERE id_cientifico = ?");
    $stmt->bind_param("i", $idCientifico); 
    $stmt->execute();

    $stmt = $mysqli->prepare("DELETE FROM cientificos WHERE id = ?");
    $stmt->bind_param("i", $idCientifico); 
    $stmt->execute();

    header("Location: ../Vista/portada.php");
    exit();
?>
