<?php

require_once 'models/UserDataModel.php';
require_once 'models/UserLoginModel.php';

class RegistroController
{
    public function mostrarFormularioRegistro()
    {
        include_once 'views/registro.php';
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function registrar()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Recuperar datos del formulario
            $nombre = $this->test_input($_POST['nombre']);
            $apellidos = $this->test_input($_POST['apellidos']);
            $email = $this->test_input($_POST['email']);
            $telefono = $_POST['telefono'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $direccion = $this->test_input($_POST['direccion']);
            $sexo = $this->test_input($_POST['sexo']);
            $usuario = $this->test_input($_POST['usuario']);
            $password = $this->test_input($_POST['password']);

            // Validar que el usuario no exista
            $userLoginModel = new UserLoginModel();
            $existeUsuario = $userLoginModel->existeUsuario($usuario);
            $existeEmail = $userLoginModel->existeEmail($email);

            if ($existeUsuario) {
                // El usuario ya existe, mostrar mensaje de error y redirigir al formulario de registro
                setcookie("mensaje_error", "El nombre de usuario ya está en uso. Por favor, elige otro.", time() + 3, "/");
                header("Location: index.php?controller=registro&action=mostrarFormularioRegistro");
                exit;
            }

            if ($existeEmail) {
                // El usuario ya existe, mostrar mensaje de error y redirigir al formulario de registro
                setcookie("mensaje_error", "El correo electrónico ya está en uso. Por favor, utiliza otro.", time() + 3, "/");
                header("Location: index.php?controller=registro&action=mostrarFormularioRegistro");
                exit;
            }

            // Encriptar la contraseña
            $passwordEncriptada = password_hash($password, PASSWORD_DEFAULT);

            // Insertar datos en la tabla users_data
            $userDataModel = new UserDataModel();
            $userDataModel->insertarUsuario($nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo);

            // Obtener el ID del usuario insertado
            $idUser = $userDataModel->obtenerIdUsuario($email);

            // Insertar datos en la tabla users_login
            $userLoginModel->insertarUsuario($idUser, $usuario, $passwordEncriptada, 'user');

            // Redirigir al usuario a otra página (por ejemplo, la página de inicio de sesión)
            header("Location: index.php?controller=login&action=mostrarFormularioLogin");
            exit;
        }
    }
}
