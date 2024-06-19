<?php
require_once 'config.php';

class UserDataModel
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Función para insertar un nuevo usuario
    public function insertarUsuario($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo)
    {
        try {
            $query = "INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo) 
                      VALUES (:nombre, :apellidos, :email, :telefono, :fecha_nacimiento, :direccion, :sexo)";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':email' => $email,
                ':telefono' => $telefono,
                ':fecha_nacimiento' => $fecha_nacimiento,
                ':direccion' => $direccion,
                ':sexo' => $sexo
            ));
            return true; // Indicar que se insertó correctamente
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al insertar usuario", $e);
            return false;
        }
    }

    // Función para obtener todos los usuarios
    public function obtenerUsuarios()
    {
        try {
            $query = "SELECT * FROM users_data";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener usuarios", $e);
            return false;
        }
    }

    // Función para obtener el ID de usuario por su email
    public function obtenerIdUsuario($email)
    {
        try {
            $query = "SELECT idUser FROM users_data WHERE email = :email";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':email' => $email));
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['idUser'];
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener ID de usuario", $e);
            return false;
        }
    }

    // Función para obtener un usuario por su ID
    public function obtenerUsuarioById($id)
    {
        try {
            $query = "SELECT * FROM users_data WHERE idUser = :id";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':id' => $id));
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener usuario por ID", $e);
            return false;
        }
    }

    // Función para actualizar los datos de un usuario
    public function actualizarUsuario($idUsuario, $nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo)
    {
        try {
            $query = "UPDATE users_data 
                      SET nombre = :nombre, 
                          apellidos = :apellidos, 
                          email = :email, 
                          telefono = :telefono, 
                          fecha_nacimiento = :fecha_nacimiento, 
                          direccion = :direccion, 
                          sexo = :sexo 
                      WHERE idUser = :idUsuario";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':email' => $email,
                ':telefono' => $telefono,
                ':fecha_nacimiento' => $fecha_nacimiento,
                ':direccion' => $direccion,
                ':sexo' => $sexo,
                ':idUsuario' => $idUsuario
            ));
            return true; // Indicar que se actualizó correctamente
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al actualizar usuario", $e);
            return false;
        }
    }

    // Función para obtener todos los usuarios
    public function obtenerTodosUsuarios()
    {
        try {
            $query = "SELECT * FROM users_data";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener todos los usuarios", $e);
            return false;
        }
    }

    // Función para eliminar un usuario por su ID
    public function eliminarUsuario($idUsuario)
    {
        try {
            // Eliminar usuario de la tabla users_login
            $query = "DELETE FROM users_login WHERE idUser = :idUsuario";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idUsuario' => $idUsuario));

            // Eliminar citas del usuario
            $query = "DELETE FROM citas WHERE idUser = :idUsuario";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idUsuario' => $idUsuario));

            // Eliminar noticias del usuario
            $query = "DELETE FROM noticias WHERE idUser = :idUsuario";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idUsuario' => $idUsuario));

            // Eliminar usuario de la tabla users_data
            $query = "DELETE FROM users_data WHERE idUser = :idUsuario";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idUsuario' => $idUsuario));

            // Retorna el número de filas afectadas
            return $statement->rowCount();
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al eliminar usuario", $e);
            return false;
        }
    }

    // Función para manejar los errores de base de datos
    private function handleDatabaseError($errorMessage, $exception)
    {
        echo "$errorMessage: " . $exception->getMessage();
    }
}
