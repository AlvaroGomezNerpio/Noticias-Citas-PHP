<?php

require_once 'models/NoticiasModel.php';

class NoticiasController
{

    private function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function index()
    {
        // Obtener todas las noticias desde el modelo
        $noticiasModel = new NoticiasModel();
        $noticias = $noticiasModel->obtenerTodasNoticias();

        // Cargar la vista de noticias y pasarle los datos
        include_once 'views/noticias.php';
    }

    public function noticiasAdmin()
    {
        // Obtener todas las noticias desde el modelo
        $noticiasModel = new NoticiasModel();
        $noticias = $noticiasModel->obtenerTodasNoticias();

        // Cargar la vista de noticias y pasarle los datos
        include_once 'views/noticias_administracion.php';
    }

    public function agregarNoticia()
    {

        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
                // No se ha enviado un archivo de imagen o ha ocurrido un error
                $this->redirectWithErrorMessage("Debe seleccionar una imagen.");
            }

            // Ruta donde se guardarán las imágenes
            $uploadDirectory = 'uploads/noticias/';

            // Generar un nombre único para la imagen
            $fileName = uniqid() . '_' . basename($_FILES['imagen']['name']);
            $targetPath = $uploadDirectory . $fileName;

            // Mover el archivo de imagen al directorio de destino
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
                // Error al cargar la imagen
                $this->redirectWithErrorMessage("Error al cargar la imagen.");
            }

            // La imagen se ha cargado correctamente, ahora guardamos la noticia en la base de datos
            $titulo = $this->test_input($_POST['titulo']);
            $texto = $this->test_input($_POST['texto']);
            $fecha = date('Y-m-d');
            $idUser = $_SESSION['usuario']['idUser']; // Suponiendo que tenemos el ID del usuario en la sesión

            // Instanciar el modelo y llamar al método para guardar la noticia
            $noticiasModel = new NoticiasModel();
            $resultado = $noticiasModel->agregarNoticia($titulo, $targetPath, $texto, $fecha, $idUser);

            if ($resultado) {
                // La noticia se ha guardado correctamente
                $this->redirect("index.php?controller=noticias&action=noticiasAdmin");
            } else {
                // Error al guardar la noticia
                $this->redirectWithErrorMessage("Error al guardar la noticia.");
            }
        } else {
            // Mostrar formulario para agregar noticia
            $this->redirectWithErrorMessage("Error en el formulario.");
        }
    }


    // Función para eliminar una noticia
    public function eliminar()
    {
        if (isset($_GET['id'])) {
            $idNoticia = $_GET['id'];
            $noticiaModel = new NoticiasModel();

            $noticia = $noticiaModel->obtenerNoticiaPorId($idNoticia);
            unlink($noticia['imagen']);

            $noticiaModel->eliminarNoticia($idNoticia);
            // Redireccionar a la página de noticias después de eliminar la noticia
            $this->redirect("index.php?controller=noticias&action=noticiasAdmin");
        }
    }

    public function modificar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idNoticia'])) {
            $idNoticia = $_POST['idNoticia'];
            $titulo = $this->test_input($_POST['titulo']);
            $texto = $this->test_input($_POST['texto']);

            // Validar los datos antes de usarlos

            $noticiaModel = new NoticiasModel();

            if ($_FILES['imagen']['tmp_name'] != '') {
                $uploadDirectory = 'uploads/noticias/';
                $fileName = uniqid() . '_' . basename($_FILES['imagen']['name']);
                $imagen = $uploadDirectory . $fileName;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen)) {
                    $noticia = $noticiaModel->obtenerNoticiaPorId($idNoticia);
                    unlink($noticia['imagen']); // Eliminar imagen anterior

                    // Guardar la noticia con la nueva imagen
                    $resultado = $noticiaModel->modificarNoticia($idNoticia, $titulo, $texto, $imagen);
                } else {
                    // Error al cargar la imagen
                    $this->redirectWithErrorMessage("Error al cargar la imagen.");
                }
            } else {
                // Conservar la imagen actual
                $noticia = $noticiaModel->obtenerNoticiaPorId($idNoticia);
                $imagen = $noticia['imagen'];

                // Modificar la noticia con los nuevos datos
                $resultado = $noticiaModel->modificarNoticia($idNoticia, $titulo, $texto, $imagen);
            }

            if ($resultado) {
                // La noticia se ha guardado correctamente
                $this->redirect("index.php?controller=noticias&action=noticiasAdmin");
            } else {
                // Error al guardar la noticia
                $this->redirectWithErrorMessage("Error al guardar la noticia.");
            }
        }
    }

    function redirect($location)
    {
        header("Location: $location");
        exit();
    }

    function redirectWithErrorMessage($message)
    {
        setcookie("mensaje_error", $message, time() + 3, "/");
        $this->redirect("index.php?controller=noticias&action=noticiasAdmin");
    }
}
