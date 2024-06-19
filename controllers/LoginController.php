<?php

require_once 'models/UserLoginModel.php';

class LoginController
{

    public function mostrarFormularioLogin()
    {
        include_once 'views/login.php';
    }

    // Función para limpiar los datos recibidos del cliente
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function autenticar()
    {
        // Verificar si se ha enviado el formulario por POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar si se han proporcionado usuario y contraseña
            if (empty($_POST['usuario']) || empty($_POST['password'])) {
                // Si falta algún campo, redirigir con un mensaje de error
                $this->redirectWithErrorMessage("Por favor, complete todos los campos.");
            }

            // Recuperar datos del formulario y limpiarlos
            $usuario = $this->test_input($_POST['usuario']);
            $password = $this->test_input($_POST['password']);

            // Verificar la autenticación
            $userLoginModel = new UserLoginModel();
            $usuarioAutenticado = $userLoginModel->autenticarUsuario($usuario, $password);

            if ($usuarioAutenticado) {
                // Iniciar sesión y guardar datos del usuario
                session_start();
                $_SESSION['usuario'] = $usuarioAutenticado;

                // Redirigir al usuario a la página de inicio
                $this->redirect("index.php?controller=home&action=index");
            } else {
                // Si las credenciales son incorrectas, redirigir con un mensaje de error
                $this->redirectWithErrorMessage("Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.");
            }
        }
    }

    public function cerrarSesion()
    {
        // Iniciar sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Eliminar todas las variables de sesión
        session_unset();
        // Destruir la sesión
        session_destroy();
        // Redirigir al usuario a la página de inicio
        $this->redirect("index.php");
    }

    // Función de redirección genérica
    private function redirect($location)
    {
        header("Location: $location");
        exit();
    }

    // Función para redirigir con un mensaje de error
    private function redirectWithErrorMessage($message)
    {
        setcookie("mensaje_error", $message, time() + 3, "/");
        $this->redirect("index.php?controller=login&action=mostrarFormularioLogin");
    }
}
