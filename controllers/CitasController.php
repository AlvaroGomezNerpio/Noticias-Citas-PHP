<?php
// app/controllers/CitasController.php

require_once 'models/CitasModel.php';
require_once 'models/UserDataModel.php';

class CitasController
{
    // Función para limpiar los datos recibidos del cliente
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Función de redirección genérica
    private function redirect($location)
    {
        header("Location: $location");
        exit();
    }

    // Función de redirección con mensaje de error
    private function redirectWithErrorMessage($message)
    {
        setcookie("mensaje_error", $message, time() + 3, "/");
        $this->redirect("index.php?controller=citas&action=index");
    }

    public function index()
    {
        // Verificar si el usuario está autenticado
        session_start();
        if (!isset($_SESSION['usuario'])) {
            // Si el usuario no está autenticado, redirigir al inicio de sesión con un mensaje de error
            $this->redirectWithErrorMessage("Debe iniciar sesión para acceder a las citas.");
        }

        // Obtener el ID del usuario desde la sesión
        $idUsuario = $_SESSION['usuario']['idUser'];

        // Obtener las citas del usuario desde la base de datos
        $citasModel = new CitasModel();
        $citas = $citasModel->getCitasUsuario($idUsuario);

        // Cargar la vista de citaciones y pasarle los datos
        include_once 'views/citaciones.php';
    }

    public function getCitasAdminidUsuario($id = null)
    {

        if (isset($_GET['id'])) {

            $idUser = $_GET['id'];

            $usuariosModel = new UserDataModel();
            $usuarios = $usuariosModel->obtenerUsuarioById($idUser);


            $citasModel = new CitasModel();
            $citas = $citasModel->getCitasUsuario($idUser);
        } else if ($id !== null) {

            $idUser = $id;

            $usuariosModel = new UserDataModel();
            $usuarios = $usuariosModel->obtenerUsuarioById($idUser);

            $citasModel = new CitasModel();
            $citas = $citasModel->getCitasUsuario($idUser);
        } else {

            $citas = [];
        }

        // Cargar la vista de citaciones y pasarle los datos
        include_once 'views/citas_usuario_administracion.php';
    }

    public function mostrarFormularioCita()
    {
        // Verificar si el usuario está autenticado
        session_start();
        if (!isset($_SESSION['usuario'])) {
            // Si el usuario no está autenticado, redirigir al inicio de sesión con un mensaje de error
            $this->redirectWithErrorMessage("Debe iniciar sesión para acceder al formulario de cita.");
        }

        // Cargar la vista de formulario de cita
        include_once 'views/formulario_cita.php';
    }

    public function crearCita()
    {
        // Verificar si se ha enviado el formulario de solicitud de cita
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperar los datos del formulario
            $fecha = $_POST['fecha'];
            $motivo = $_POST['motivo'];

            // Verificar que los datos no estén vacíos
            if (!empty($fecha) && !empty($motivo)) {
                // Obtener el ID del usuario desde la sesión

                if (isset($_POST['idUsuario'])) {

                    $idUsuario = $_POST['idUsuario'];
                } else {
                    session_start();
                    $idUsuario = $_SESSION['usuario']['idUser'];
                }

                // Insertar la nueva cita en la base de datos
                $citasModel = new CitasModel();
                $citasModel->insertarCita($idUsuario, $fecha, $motivo);

                if (isset($_POST['idUsuario'])) {

                    $this->getCitasAdminidUsuario($_POST['idUsuario']);
                } else {

                    // Redirigir a la página de citaciones después de solicitar la cita
                    $this->redirect("index.php?controller=citas&action=index");
                }
            } else {
                // Si falta algún dato, mostrar un mensaje de error o manejarlo de otra manera
                $this->redirectWithErrorMessage("Por favor, complete todos los campos del formulario de cita.");
            }
        } else {
            // Si no se ha enviado el formulario por POST, redirigir a la página de citaciones con un mensaje de error
            $this->redirectWithErrorMessage("Debe enviar el formulario para solicitar una cita.");
        }
    }

    public function formulario()
    {
        // Verificar si los parámetros de la cita están presentes en la URL
        if (isset($_GET['idCita']) && isset($_GET['fecha']) && isset($_GET['motivo']) && isset($_GET['id'])) {
            // Obtener los parámetros de la cita de la URL
            $idCita = $_GET['idCita'];
            $fecha = $_GET['fecha'];
            $motivo = $_GET['motivo'];
            $id = $_GET['id'];

            if (isset($_GET['admin'])) {

                $admin = $_GET['admin'];
            }

            // Pasar los datos de la cita a la vista
            include_once 'views/formulario_cita.php';
        } else {
            // Si falta algún parámetro, redirigir con un mensaje de error
            $this->redirectWithErrorMessage("No se proporcionaron todos los parámetros necesarios para mostrar el formulario de cita.");
        }
    }

    public function modificar()
    {
        // Verificar si se han enviado datos por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los datos del formulario y limpiarlos
            $idCita = $this->test_input($_POST['idCita']);
            $fecha = $this->test_input($_POST['fecha']);
            $motivo = $this->test_input($_POST['motivo']);

            // Actualizar la cita en la base de datos
            $citaModel = new CitasModel();
            $resultado = $citaModel->actualizarCita($idCita, $fecha, $motivo);

            if (isset($_POST['admin']) && $_POST['admin'] = TRUE) {
                $this->getCitasAdminidUsuario($_POST['id']);
            }

            // Redireccionar a la página de citaciones
            $this->redirect("index.php?controller=citas&action=index");
        }
    }

    public function borrar()
    {
        // Verificar si se ha enviado el ID de la cita por GET
        if (isset($_GET['idCita'])) {
            // Obtener el ID de la cita desde la URL
            $idCita = $_GET['idCita'];

            // Eliminar la cita de la base de datos
            $citaModel = new CitasModel();
            $resultado = $citaModel->eliminarCita($idCita);

            if (isset($_GET['user'])) {

                $this->getCitasAdminidUsuario($_GET['user']);
            }

            // Redireccionar a la página de citaciones
            $this->redirect("index.php?controller=citas&action=index");
        } else {
            // Si no se recibió el ID de la cita por GET, redirigir con un mensaje de error
            $this->redirectWithErrorMessage("No se proporcionó un ID de cita válido.");
        }
    }

    public function citasAdmin()
    {
        // Aquí deberías obtener la lista de usuarios registrados desde el modelo de usuarios
        // Supongamos que tienes un método en el modelo de usuarios llamado obtenerUsuariosRegistrados()

        // Llamamos al método del modelo para obtener la lista de usuarios
        $usuariosModel = new UserDataModel();
        $usuarios = $usuariosModel->obtenerUsuarios();

        // Llamamos a la vista y pasamos la lista de usuarios como parámetro
        include('views/citas_administracion.php');
    }

    public function gatCitasAdmin($idUsuario)
    {

        $idUsuario;
        $citasModel = new CitasModel();
        $citas = $citasModel->getCitaPorId($idUsuario);

        // Llamamos a la vista y pasamos las citas y el ID del usuario como parámetros
        include('views/citas_usuario_administracion.php');
    }
}
