<?php
require_once 'config.php';

class CitasModel
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Función para obtener las citas de un usuario por su ID
    public function getCitasUsuario($idUsuario)
    {
        try {
            $query = "SELECT * FROM citas WHERE idUser = :idUsuario";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idUsuario' => $idUsuario));
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener las citas del usuario", $e);
            return false;
        }
    }

    // Función para obtener una cita por su ID
    public function getCitaPorId($idCita)
    {
        try {
            $query = "SELECT * FROM citas WHERE idCita = :idCita";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idCita' => $idCita));
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener la cita", $e);
            return false;
        }
    }

    // Función para insertar una nueva cita
    public function insertarCita($idUsuario, $fecha, $motivo)
    {
        try {
            $query = "INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (:idUsuario, :fecha, :motivo)";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(
                ':idUsuario' => $idUsuario,
                ':fecha' => $fecha,
                ':motivo' => $motivo
            ));
            return $statement->rowCount() > 0; // Verificar si se insertó correctamente
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al insertar la cita", $e);
            return false;
        }
    }

    // Función para actualizar una cita existente
    public function actualizarCita($idCita, $fecha, $motivo)
    {
        try {
            $query = "UPDATE citas SET fecha_cita = :fecha, motivo_cita = :motivo WHERE idCita = :idCita";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(
                ':fecha' => $fecha,
                ':motivo' => $motivo,
                ':idCita' => $idCita
            ));
            return $statement->rowCount() > 0; // Verificar si se actualizó correctamente
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al actualizar la cita", $e);
            return false;
        }
    }

    // Función para eliminar una cita
    public function eliminarCita($idCita)
    {
        try {
            $query = "DELETE FROM citas WHERE idCita = :idCita";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idCita' => $idCita));
            return $statement->rowCount() > 0; // Verificar si se eliminó correctamente
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al eliminar la cita", $e);
            return false;
        }
    }

    // Función para manejar los errores de base de datos
    private function handleDatabaseError($errorMessage, $exception)
    {
        echo "$errorMessage: " . $exception->getMessage();
    }
}
