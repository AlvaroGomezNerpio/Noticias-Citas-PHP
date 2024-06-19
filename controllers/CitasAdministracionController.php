<?php

require_once 'models/UserDataModel.php';
require_once 'models/CitasModel.php';

class CitasAdministracionController
{
    // Función para cargar la vista de administración de citas
    public function index()
    {
        // Obtener la lista de usuarios registrados
        $usuariosModel = new UserDataModel();
        $usuarios = $usuariosModel->obtenerUsuarios();

        // Cargar la vista de administración de citas y pasar la lista de usuarios
        include('views/citas_administracion.php');
    }

    // Función para mostrar las citas de un usuario específico
    public function mostrarCitasUsuario($idUsuario)
    {
        // Verificar si se proporcionó un ID de usuario válido
        if (!isset($idUsuario) || empty($idUsuario)) {
            // Si no se proporcionó un ID válido, redirigir con un mensaje de error
            $this->redirectWithErrorMessage("No se proporcionó un ID de usuario válido.");
        }

        // Obtener las citas del usuario con el ID proporcionado
        try {
            $citasModel = new CitasModel();
            $citas = $citasModel->getCitaPorId($idUsuario);
        } catch (Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir al obtener las citas
            $this->redirectWithErrorMessage("Error al obtener las citas del usuario.");
        }

        // Cargar la vista de administración de citas del usuario y pasar las citas
        include('views/citas_usuario_administracion.php');
    }

    // Función para redirigir con un mensaje de error
    private function redirectWithErrorMessage($message)
    {
        setcookie("mensaje_error", $message, time() + 3, "/");
        $this->redirect("index.php?controller=citasAdministracion&action=index");
    }

    // Función de redirección genérica
    private function redirect($location)
    {
        header("Location: $location");
        exit();
    }
}
