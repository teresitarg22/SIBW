<?php
    /*  En este fichero, hemos incluido todas las instrucciones que tienen que ver con nuestra base de datos, 
        para separar correctamente lo que sería el modelo del controlador.
    */

    class Database {
        private static $instancia = null;
        private $mysqli;
    
        // Constructor que inicia la conexión con la BD e informa en caso de error:
        private function __construct() {
            $this->mysqli = new mysqli('database', 'marioytere', 'tiger', 'SIBW');
            if ($this->mysqli->connect_errno) {
                echo ("Fallo al conectar: " . $this->mysqli->connect_error);
            }
        }
       
        // Función que devuelve una instancia (o la crea si no existe):
        public static function getInstancia() {
            if (self::$instancia == null) {
                self::$instancia = new Database();
            }
            return self::$instancia;
        }
        // Función que devuelve la conexión:
        public function getConexion() {
            return $this->mysqli;
        }
    }

    // -----------------------------------------
    // Nos conectamos a la base de datos:
        $bd = Database::getInstancia();
        $mysqli = $bd->getConexion();

    // -----------------------------------------------------------------------    
    // Función para obtener la información de un científico. 
    function getCientifico($idCientifico) {
        global $mysqli;

        // Consultamos la base de datos y almacenamos el resultado:
        $res = $mysqli->query("SELECT id, nombre, fecha, biografia, frases FROM cientificos WHERE id=" . $idCientifico);
        
        // Creamos una variable científico que esté vacía (o por defecto) por si se da el caso de que el id sea incorrecto.
        $cientifico = array('id' => '-1', 'nombre' => 'XXX', 'fecha' => 'YYY', 'biografia' => 'ZZZ', 'frases' => 'AAA');
        
        // Si se han encontrado resultados en la consulta, se los pasamos científico:
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $cientifico = array(
                'id' => $row['id'], 
                'nombre' => $row['nombre'], 
                'fecha' => $row['fecha'], 
                'biografia' => $row['biografia'], 
                'frases' => $row['frases']
            );
        }
        
        // Devolvemos el array asociativo de científico.
        return $cientifico;
    }

    // -----------------------------------------------------------------------   
    // Función para obtener la galería de fotos de un científico.
    function getGaleria($idCientifico) {
        global $mysqli;

        // Consultamos la base de datos y almacenamos los datos de las imágenes:
        $res = $mysqli->query("SELECT * FROM galeria WHERE id_cientifico=" . $idCientifico);

        // Creamos un array para guardar los datos:
        $fotos = array();

        // Si se han encontrado resultados en la consulta, guardamos la info de cada foto de la galeria:
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()){
                $foto = array(
                    'id' => $row['id'], 
                    'id_cientifico' => $row['id_cientifico'], 
                    'foto' => $row['foto'], 
                    'pieFoto' => $row['pieFoto']
                );

                // Guardamos la foto en el array de fotos:
                array_push($fotos, $foto);
            }
        }

        // Devolvemos el array asociativo de las imágenes.
        return $fotos;
    }

    // ------------------------------------------------------------
    // Función para obtener los enlaces extras de un científico.
    function getEnlaces($idCientifico) {
        global $mysqli;

        // Consultamos la base de datos y almacenamos los datos de los enlaces:
        $res = $mysqli->query("SELECT * FROM enlaces WHERE id_cientifico=" . $idCientifico);

        // Creamos un array para guardar los datos:
        $enlaces = array();

        // Si se han encontrado resultados en la consulta, guardamos la info de cada enlace:
        if ($res->num_rows > 0) {
            $enlaces = array();
            while($row = $res->fetch_assoc()){
                $enlace = array(
                    'id' => $row['id'],
                    'id_cientifico' => $row['id_cientifico'],
                    'enlace' => $row['enlace'], 
                    'infoEnlace' => $row['infoEnlace']
                );
                
                array_push($enlaces, $enlace);
            }
        }

        // Devolvemos el array asociativo de los enlaces.
        return $enlaces;
    }

    // ------------------------------------------------------------
    // Función para obtener los comentarios extras de un científico.
    function getComentarios($idCientifico) {
        global $mysqli;
        
        // Consultamos la base de datos y almacenamos los datos de los comentarios:
        $resultado = $mysqli->query("SELECT * FROM comentarios WHERE id_cientifico = $idCientifico ORDER BY fecha ASC, hora ASC");
        
        // Creamos un array para guardar los datos:
        $comentarios = array();

        // Si se han encontrado resultados en la consulta, guardamos la info de cada comentario:
        if($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $comentario = array(
                    'id' => $fila['id'],
                    'nombre' => $fila['nombre'],
                    'email' => $fila['email'],
                    'comentario' => $fila['comentario'],
                    'fecha' => $fila['fecha'],
                    'hora' => $fila['hora']
                );

                array_push($comentarios, $comentario);
            }
        }
        
        // Devolvemos el array asociativo de los comentarios.
        return $comentarios;
    }

    function updateComentario($id, $comentario){
        global $mysqli;

        // Construye la consulta SQL de actualización
        $query = "UPDATE comentarios SET comentario = '$comentario' WHERE id = '$id'";
        
        // Ejecuta la consulta
        $resultado = $mysqli->query($query);
        
        // Verifica si la actualización fue exitosa
        if ($resultado) 
            return true; // Retorna true si se actualizó correctamente
        else 
            return false; // Retorna false si hubo un error en la actualización
    }
?>