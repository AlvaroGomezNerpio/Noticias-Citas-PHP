<?php
// controllers/PerfilController.php

require_once 'models/UserDataModel.php';
require_once 'models/UserLoginModel.php';

class PerfilController
{
    // Función para verificar si el usuario está autenticado
    private function verificarAutenticacion()
    {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            // Si el usuario no está autenticado, redirigir al inicio de sesión
            $this->redirect("index.php?controller=login&action=mostrarFormularioLogin");
            exit();
        }
    }

    // Función para limpiar los datos del formulario
    private function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Mostrar perfil de usuario
    public function index()
    {
        $this->verificarAutenticacion();

        // Obtener datos del usuario desde el modelo
        $userDataModel = new UserDataModel();
        $usuario = $userDataModel->obtenerUsuarioById($_SESSION['usuario']['idUser']);

        // Cargar la vista de perfil y pasarle los datos
        include_once 'views/perfil.php';
    }

    public function editar()
    {
        $this->verificarAutenticacion();

        // Obtener datos del usuario desde el modelo
        $userDataModel = new UserDataModel();
        $usuario = $userDataModel->obtenerUsuarioById($_SESSION['usuario']['idUser']);

        // Cargar la vista de edición de perfil y pasarle los datos
        include_once 'views/editar_perfil.php';
    }

    // Actualizar perfil de usuario
    public function actualizar()
    {
        $this->verificarAutenticacion();

        // Limpiar datos del formulario
        $nombre = $this->test_input($_POST['nombre']);
        $apellidos = $this->test_input($_POST['apellidos']);
        $email = $this->test_input($_POST['email']);
        $telefono = $this->test_input($_POST['telefono']);
        $fecha_nacimiento = $this->test_input($_POST['fecha_nacimiento']);
        $direccion = $this->test_input($_POST['direccion']);
        $sexo = $this->test_input($_POST['sexo']);
        $idUsuario = isset($_POST['idUser']) ? $_POST['idUser'] : $_SESSION['usuario']['idUser'];

        // Verificar si se ha actualizado el rol
        if (isset($_POST['rol'])) {
            $rol = $_POST['rol'];
            $userLoginModel = new UserLoginModel();
            $userLoginModel->actualizarRolUsuario($idUsuario, $rol);
        }

        // Actualizar los datos del usuario en la base de datos
        $userDataModel = new UserDataModel();
        $userDataModel->actualizarUsuario($idUsuario, $nombre, $apellidos, $email, $telefono, $fecha_nacimiento, $direccion, $sexo);

        // Redirigir al usuario de vuelta a la página de perfil o administración según corresponda
        if (isset($_POST['rol'])) {
            $this->redirect("index.php?controller=UsuariosAdmin&action=index");
        } else {
            $this->redirectPerfil();
        }
    }


    // Cambiar contraseña de usuario
    public function cambiarContrasena()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->verificarAutenticacion();

            // Obtener datos del formulario
            $idUser = $_SESSION['usuario']['idUser'];
            $contraseñaActual = $_POST['contraseña_actual'];
            $nuevaContraseña = $_POST['nueva_contraseña'];
            $confirmarNuevaContraseña = $_POST['confirmar_nueva_contraseña'];

            // Verificar que las contraseñas coincidan
            if ($nuevaContraseña !== $confirmarNuevaContraseña) {
                $this->redirectPerfilWithMessage("Las contraseñas no coinciden.");
            } else {
                // Verificar si la contraseña actual es correcta
                $userLoginModel = new UserLoginModel();
                if ($userLoginModel->verificarContraseña($idUser, $contraseñaActual)) {
                    $contraseñaEncriptada = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
                    $result = $userLoginModel->cambiarContrasena($idUser, $contraseñaEncriptada);
                    if ($result) {
                        $this->redirectPerfilWithMessage("Contraseña cambiada correctamente.", "mensaje_exito");
                    } else {
                        $this->redirectPerfilWithMessage("Error al cambiar la contraseña. Inténtalo de nuevo.");
                    }
                } else {
                    $this->redirectPerfilWithMessage("La contraseña actual es incorrecta.");
                }
            }
        }

        // Si no se ha enviado el formulario, redirigir al perfil
        $this->redirectPerfil();
    }

    // Redirigir al perfil con un mensaje opcional
    private function redirectPerfilWithMessage($message, $type = "mensaje_error")
    {
        setcookie($type, $message, time() + 3, "/");
        $this->redirect("index.php?controller=perfil&action=index");
    }

    // Redirigir al perfil
    private function redirectPerfil()
    {
        $this->redirect("index.php?controller=perfil&action=index");
        exit;
    }

    // Función de redirección genérica
    private function redirect($location)
    {
        header("Location: $location");
        exit();
    }
}
