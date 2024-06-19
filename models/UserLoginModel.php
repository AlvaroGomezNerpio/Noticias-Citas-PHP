<?php
require_once 'config.php';

class UserLoginModel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Función para autenticar un usuario
    public function autenticarUsuario($usuario, $password) {
        try {
            // Obtener la contraseña encriptada del usuario
            $query = "SELECT * FROM users_login WHERE usuario = :usuario";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':usuario' => $usuario));
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            // Verificar la contraseña
            if ($result && password_verify($password, $result['password'])) {
                unset($result['password']); // Eliminar la contraseña por seguridad
                return $result;
            } else {
                return false; // Autenticación fallida
            }
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al autenticar usuario", $e);
            return false;
        }
    }

    // Función para obtener los datos de un usuario por su ID
    public function getUserIdUser($idUser) {
        try {
            // Obtener los datos del usuario
            $query = "SELECT * FROM users_login WHERE idUser = :idUser";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idUser' => $idUser));
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            unset($result['password']); // Eliminar la contraseña por seguridad
            return $result;
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener usuario por ID", $e);
            return false;
        }
    }

    // Función para verificar si un usuario existe por su nombre de usuario
    public function existeUsuario($usuario) {
        try {
            $query = "SELECT COUNT(*) AS count FROM users_login WHERE usuario = :usuario";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':usuario' => $usuario));
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al verificar existencia de usuario", $e);
            return false;
        }
    }

    // Función para verificar si un email existe en la base de datos
    public function existeEmail($email) {
        try {
            $query = "SELECT COUNT(*) AS count FROM users_data WHERE email = :email";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':email' => $email));
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al verificar existencia de email", $e);
            return false;
        }
    }

    // Función para actualizar el rol de un usuario por su ID
    public function actualizarRolUsuario($idUsuario, $nuevoRol) {
        try {
            $query = "UPDATE users_login SET rol = :nuevoRol WHERE idUser = :idUser";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':nuevoRol' => $nuevoRol, ':idUser' => $idUsuario));
            return $statement->rowCount(); // Retorna el número de filas afectadas
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al actualizar rol de usuario", $e);
            return false;
        }
    }

    // Función para añadir un usuario a la base de datos
    public function insertarUsuario($idUser, $usuario, $password, $rol) {
        try {
            $query = "INSERT INTO users_login (idUser, usuario, password, rol) VALUES (:idUser, :usuario, :password, :rol)";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(
                ':idUser' => $idUser,
                ':usuario' => $usuario,
                ':password' => $password,
                ':rol' => $rol
            ));
            return true; // Indicar que se insertó correctamente
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al insertar usuario", $e);
            return false;
        }
    }

    // Función para obtener la contraseña de un usuario por su ID
    public function obtenerContraseña($idUser) {
        try {
            $query = "SELECT password FROM users_login WHERE idUser = :idUser";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':idUser' => $idUser));
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al obtener contraseña de usuario", $e);
            return false;
        }
    }

    // Función para verificar si una contraseña coincide con la almacenada en la base de datos
    public function verificarContraseña($idUser, $contraseña) {
        try {
            // Obtener la contraseña encriptada de la base de datos
            $contraseñaEncriptadaDB = $this->obtenerContraseña($idUser);

            // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
            return password_verify($contraseña, $contraseñaEncriptadaDB['password']);
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al verificar contraseña de usuario", $e);
            return false;
        }
    }

    // Función para cambiar la contraseña de un usuario
    public function cambiarContrasena($idUser, $nuevaContraseña) {
        try {
            // Actualizar la contraseña en la base de datos
            $query = "UPDATE users_login SET password = :nuevaContrasena WHERE idUser = :idUser";
            $statement = $this->pdo->prepare($query);
            $statement->execute(array(':nuevaContrasena' => $nuevaContraseña, ':idUser' => $idUser));
            return $statement->rowCount(); // Retorna el número de filas afectadas
        } catch (PDOException $e) {
            // Manejar cualquier error de base de datos
            $this->handleDatabaseError("Error al cambiar contraseña de usuario", $e);
            return false;
        }
    }

    // Función para manejar los errores de base de datos
    private function handleDatabaseError($errorMessage, $exception) {
        echo "$errorMessage: " . $exception->getMessage();
    }
}
