<?php
require_once 'config.php';

class NoticiasModel
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Función para obtener todas las noticias
    public function obtenerTodasNoticias()
    {
        try {
            $query = "SELECT n.*, u.nombre AS nombre_usuario
                      FROM noticias AS n
                      INNER JOIN users_data AS u ON n.idUser = u.idUser";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener todas las noticias", $e);
            return false;
        }
    }

    // Función para agregar una nueva noticia
    public function agregarNoticia($titulo, $imagen, $texto, $fecha, $idUser)
    {
        try {
            $query = "INSERT INTO noticias (titulo, imagen, texto, fecha, idUser) VALUES (:titulo, :imagen, :texto, :fecha, :idUser)";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(
                ':titulo' => $titulo,
                ':imagen' => $imagen,
                ':texto' => $texto,
                ':fecha' => $fecha,
                ':idUser' => $idUser
            ));
            return $statement->rowCount() > 0; // Verificar si se insertó correctamente
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al agregar la noticia", $e);
            return false;
        }
    }

    // Función para eliminar una noticia por su ID
    public function eliminarNoticia($idNoticia)
    {
        try {
            $query = "DELETE FROM noticias WHERE idNoticia = :idNoticia";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idNoticia' => $idNoticia));
            return true; // Indicar que se eliminó correctamente
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al eliminar la noticia", $e);
            return false;
        }
    }

    // Función para obtener una noticia por su ID
    public function obtenerNoticiaPorId($idNoticia)
    {
        try {
            $query = "SELECT * FROM noticias WHERE idNoticia = :idNoticia";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idNoticia' => $idNoticia));
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener la noticia por ID", $e);
            return false;
        }
    }

    // Función para modificar una noticia existente
    public function modificarNoticia($idNoticia, $titulo, $texto, $imagen)
    {
        try {
            $query = "UPDATE noticias SET titulo = :titulo, texto = :texto, imagen = :imagen WHERE idNoticia = :idNoticia";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(
                ':titulo' => $titulo,
                ':texto' => $texto,
                ':imagen' => $imagen,
                ':idNoticia' => $idNoticia
            ));
            return $statement->rowCount() > 0; // Verificar si se actualizó correctamente
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al modificar la noticia", $e);
            return false;
        }
    }

    // Función para manejar los errores de base de datos
    private function handleDatabaseError($errorMessage, $exception)
    {
        echo "$errorMessage: " . $exception->getMessage();
    }
}
