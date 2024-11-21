# Proyecto Laravel 11 + Jetstream + MySQL + Vuexy

![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)
![Jetstream](https://img.shields.io/badge/Jetstream-2.x-blue.svg)
![Vuexy](https://img.shields.io/badge/Vuexy-2.x-green.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.x-orange.svg)
![PHP](https://img.shields.io/badge/PHP-8.2-purple.svg)

## Descripción General

Este proyecto es parte del trabajo de título para el Instituto Profesional San Sebastián, bajo la supervisión del profesor Sebastián Cabezas. La aplicación desarrollada es una solución completa y escalable para la gestión de parcelas, usuarios, roles, configuraciones de página y preguntas frecuentes (FAQ), construida en Laravel 11 y utilizando **Vuexy**, **MySQL**, y **Jetstream**.

## Funcionalidades Principales

- **Gestión de Usuarios**:
  - CRUD completo para la creación, edición, actualización y eliminación de usuarios.
  - Asignación de roles y definición de privilegios específicos.
  - Generación y validación de contraseñas seguras, con la opción de visualizarlas antes de confirmarlas.

- **Publicaciones de Parcelas**:
  - Creación y administración de publicaciones de parcelas.
  - Gestión y edición de detalles de las publicaciones, incluyendo fotos y características.
  - Integración de un selector de color para personalizar las configuraciones de la parcela.

- **Configuraciones de Página**:
  - Personalización de títulos, descripciones y colores.
  - Configuración de textos clave: misión, visión, sobre nosotros.
  - Administración de datos de contacto con opción de integración de Google Maps.

- **Preguntas Frecuentes (FAQ)**:
  - Funcionalidad para agregar, listar y reorganizar preguntas frecuentes.
  - Permite el reordenamiento de las FAQs de forma dinámica y guardar el nuevo orden.

- **API REST Integrada**:
  - Exposición de toda la información gestionada en el backoffice a través de una API REST.
  - Soporte para versionamiento, asegurando integraciones estables.
  - Implementación de autenticación mediante token de acceso para las APIs.

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/tu_usuario/tu_proyecto.git
    ```
2. Navega al directorio del proyecto:
    ```bash
    cd tu_proyecto
    ```
3. Instala las dependencias:
    ```bash
    composer install
    npm install && npm run dev
    ```
4. Configura el archivo `.env`:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Configura la base de datos en el archivo `.env` y luego migra las tablas:
    ```bash
    php artisan migrate
    ```
6. Inicia el servidor de desarrollo:
    ```bash
    php artisan serve
    ```

## Dependencias del Proyecto

Este proyecto incluye las siguientes dependencias clave, como se describe en el archivo `composer.json`:

### Requerimientos

- **PHP**: ^8.2
- **Laravel Framework**: ^11.9
- **Vuexy**: ~2.x
- **Jetstream**: 2.x
- **Laravel Sanctum**: ^4.0
- **Laravel Tinker**: ^2.9
- **Tightenco Ziggy**: ^2.0

### Requerimientos para el Desarrollo

- **FakerPHP Faker**: ^1.23
- **Laravel Pint**: ^1.13
- **Laravel Sail**: ^1.26
- **Mockery**: ^1.6
- **Nuno Maduro Collision**: ^8.0
- **PHPUnit**: ^11.0.1

## Nuevas Funcionalidades Implementadas

- **Generador de Contraseñas Seguras**:
  Se ha implementado una funcionalidad para generar contraseñas aleatorias y validarlas antes de la creación de un usuario. También se ha agregado la opción de ver la contraseña generada antes de confirmarla.
  
- **Reordenamiento de Preguntas Frecuentes (FAQ)**:
  Se ha agregado una funcionalidad que permite arrastrar y soltar las preguntas frecuentes (FAQ) para reordenarlas de forma dinámica. Además, se implementó la funcionalidad para guardar el nuevo orden de las FAQs a través de una solicitud AJAX.

- **Integración de API con Autenticación Bearer Token**:
  Se implementó la autenticación con Bearer Token para las APIs. Los usuarios deben autenticar sus solicitudes mediante un token para acceder a las APIs protegidas.

- **Optimización de la Vista de Settings**:
  Se mejoraron los formularios en la vista de configuraciones para hacerlos más legibles y atractivos visualmente, con validaciones en el frontend para los campos clave.

## Scripts Disponibles

El archivo `composer.json` también define varios scripts útiles:

- **post-autoload-dump**: Ejecuta `package:discover` después de la carga automática.
- **post-update-cmd**: Publica los assets de Laravel después de una actualización.
- **post-root-package-install**: Copia el archivo `.env` de ejemplo y genera una clave de aplicación.
- **post-create-project-cmd**: Genera una clave de aplicación y migra la base de datos.

## Contribuciones

Las contribuciones son bienvenidas. Por favor, envía un pull request para sugerir cambios o mejoras.

## Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).

---

**Instituto Profesional San Sebastián**  
**Profesor a cargo**: Sebastián Cabezas
