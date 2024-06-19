<?php

require_once 'models/UserDataModel.php';
require_once 'models/UserLoginModel.php';

class UsuariosAdminController
{

    public function index()
    {
        $userDataModel = new UserDataModel();
        $usuarios = $userDataModel->obtenerTodosUsuarios();

        // Cargar la vista y pasar los usuarios como datos
        require_once 'views/usuarios_administracion.php';
    }

    // Controlador para eliminar un usuario
    public function eliminarUsuario()
    {
        // Verificar si se ha proporcionado un ID de usuario válido
        if (isset($_GET['id'])) {
            $idUsuario = $_GET['id'];

            $userDataModel = new UserDataModel();
            // Eliminar usuario de la tabla users_data
            $userDataModel->eliminarUsuario($idUsuario);

            // Redirigir a la página de lista de usuarios
            $this->redirect("index.php?controller=UsuariosAdmin&action=index");
        } else {
            // Si no se proporcionó un ID de usuario válido, redirigir a la lista de usuarios
            $this->redirect("index.php?controller=UsuariosAdmin&action=index");
        }
    }

    public function formularioActualizarUsuario()
    {

        if (isset($_GET['id'])) {
            $userDataModel = new UserDataModel();
            $usuario = $userDataModel->obtenerUsuarioById($_GET['id']);

            $userLoginModel = new UserLoginModel();
            $userLogin = $userLoginModel->getUserIdUser($_GET['id']);

            include_once 'views/editar_perfil.php';
        }
    }

    // Función de redirección genérica
    private function redirect($location)
    {
        header("Location: $location");
        exit();
    }
}

?>
