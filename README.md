# Trabajo Final: PHP

Este proyecto es un sitio web completo desarrollado como ejercicio final del módulo. El sitio web puede representar una empresa ficticia o el portafolio de un programador web. La información proporcionada en el sitio es ficticia. El proyecto utiliza tecnologías como HTML5, CSS3, JavaScript, SQL y PHP.

## Características

### Base de Datos
La base de datos del sitio web contiene las siguientes tablas:

- **users_data**:
  - idUser (INT, AUTO_INCREMENT, PRIMARY KEY)
  - nombre (TEXT, NOT NULL)
  - apellidos (TEXT, NOT NULL)
  - email (TEXT, UNIQUE, NOT NULL)
  - teléfono (TEXT, NOT NULL)
  - fecha de nacimiento (DATE, NOT NULL)
  - dirección (TEXT)
  - sexo (TEXT)

- **users_login**:
  - idLogin (INT, AUTO_INCREMENT, PRIMARY KEY)
  - idUser (INT, NOT NULL, UNIQUE, FOREIGN KEY)
  - usuario (TEXT, UNIQUE, NOT NULL)
  - password (TEXT, NOT NULL)
  - rol (TEXT, NOT NULL, valores posibles: 'admin' o 'user')

- **citas**:
  - idCita (INT, AUTO_INCREMENT, PRIMARY KEY)
  - idUser (INT, NOT NULL, FOREIGN KEY)
  - fecha_cita (DATE, NOT NULL)
  - motivo_cita (TEXT)

- **noticias**:
  - idNoticia (INT, AUTO_INCREMENT, PRIMARY KEY)
  - título (TEXT, UNIQUE, NOT NULL)
  - imagen (TEXT, NOT NULL)
  - texto (LONGTEXT, NOT NULL)
  - fecha (DATE, NOT NULL)
  - idUser (INT, NOT NULL, FOREIGN KEY)

### Sitio Web
El sitio web está compuesto por las siguientes páginas:

1. **Página de Inicio (`index.html`)**:
   - Portada del sitio web con varias secciones que incluyen textos, imágenes e hipervínculos.

2. **Página de Noticias (`noticias.php`)**:
   - Muestra todas las noticias de la base de datos con título, fecha de publicación, texto de la noticia, foto de la noticia y nombre del usuario que la creó.

3. **Página de Registro (`registro.php`)**:
   - Formulario completo para registrar nuevos usuarios, insertando datos en `users_data` y `users_login`.
   - Incluye un enlace a la página de inicio de sesión.

4. **Página de Inicio de Sesión (`login.php`)**:
   - Formulario para que los usuarios inicien sesión.
   - Incluye un enlace a la página de registro.

### Funcionalidades de Usuario
- **Perfil (`perfil.php`)**:
  - Muestra y permite modificar los datos personales del usuario.

- **Citas (`citaciones.php`)**:
  - Solicitar, modificar y borrar citas.

### Funcionalidades de Administrador
- **Administración de Usuarios (`usuarios-administracion.php`)**:
  - Crear, modificar y borrar usuarios.

- **Administración de Citas (`citas-administracion.php`)**:
  - Gestionar las citas de los usuarios.

- **Administración de Noticias (`noticias-administracion.php`)**:
  - Crear, modificar y borrar noticias.

## Instalación

1. Clona el repositorio:
    ```sh
    git clone https://github.com/tuusuario/trabajo-final-php.git
    ```

2. Navega al directorio del proyecto:
    ```sh
    cd trabajo-final-php
    ```

3. Configura la base de datos:
   - Crea una base de datos en tu servidor SQL.
   - Importa el archivo `database.sql` incluido en el proyecto a tu base de datos.

4. Configura el archivo `config.php` con los detalles de tu base de datos:
    ```php
    <?php
    $host = 'localhost';
    $db = 'nombre_de_tu_base_de_datos';
    $user = 'tu_usuario';
    $pass = 'tu_contraseña';
    $charset = 'utf8mb4';
    ?>
    ```

5. Ejecuta el servidor web y abre el proyecto en tu navegador.

## Uso

- Navega a `index.php` para acceder a la página de inicio.
- Utiliza la barra de navegación para acceder a las diferentes secciones del sitio web.
- Regístrate e inicia sesión para acceder a funcionalidades adicionales según tu rol (usuario o administrador).

## Contribuir

1. Haz un fork del proyecto.
2. Crea una nueva rama (`git checkout -b feature/nueva-caracteristica`).
3. Realiza tus cambios y haz commit de ellos (`git commit -m 'Añadir nueva característica'`).
4. Sube tus cambios (`git push origin feature/nueva-caracteristica`).
5. Abre una Pull Request.
