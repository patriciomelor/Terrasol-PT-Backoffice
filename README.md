# Terrasol-PT-Backoffice

## Descripción
Terrasol-PT-Backoffice es un sistema de gestión desarrollado en Laravel 11 para administrar artículos, usuarios y roles dentro de la plataforma. Utiliza una arquitectura moderna basada en PHP 8.3 y cuenta con integraciones de bases de datos MySQL.

## Tecnologías Utilizadas
- **Framework:** Laravel 11
- **Lenguaje:** PHP 8.3
- **Base de Datos:** MySQL
- **Frontend:** Blade Templates
- **Autenticación:** Laravel Sanctum
- **Gestor de Dependencias:** Composer & NPM
- **Servidor Web:** Apache / Nginx

## Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/tuusuario/Terrasol-PT-Backoffice.git
cd Terrasol-PT-Backoffice/backoffice
```

### 2. Instalar dependencias
```bash
composer install
npm install
```

### 3. Configurar el entorno
Copiar el archivo de configuración y ajustar las credenciales de la base de datos:
```bash
cp .env.example .env
```
Modificar el `.env` según la configuración local:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 4. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 5. Migrar la base de datos
```bash
php artisan migrate --seed
```

### 6. Ejecutar el servidor local
```bash
php artisan serve
```

## Uso
Acceder a `http://127.0.0.1:8000`
- Iniciar sesión con las credenciales de usuario administrador generadas con los seeders.

## Rutas y Endpoints

### Roles:
- `GET /roles` (Lista de roles)
- `POST /roles` (Crear un rol)
- `PUT /roles/{id}` (Actualizar un rol)
- `DELETE /roles/{id}` (Eliminar un rol)

### Usuarios:
- `GET /users` (Administración de usuarios)
- `POST /users` (Crear usuario)
- `PUT /users/{id}` (Actualizar usuario)
- `DELETE /users/{id}` (Eliminar usuario)

### Artículos:
- `GET /articles` (Gestión de artículos)
- `POST /articles` (Crear artículo)
- `PUT /articles/{id}` (Actualizar artículo)
- `DELETE /articles/{id}` (Eliminar artículo)

## API
La aplicación también cuenta con una API REST para acceder a los datos.

### Autenticación:
Todas las rutas de la API requieren autenticación mediante token Bearer. Puedes obtener un token al iniciar sesión en la aplicación.

### Rutas:
#### **Obtener configuración general**
- **Método:** `GET`
- **Ruta:** `/api/settings`
- **Descripción:** Obtiene la configuración general de la aplicación (misión, visión, etc.).
- **Respuesta:**
```json
{
  "mission": "Misión de la empresa",
  "vision": "Visión de la empresa",
  "about_us": "Información sobre la empresa"
}
```

#### **Obtener lista de artículos**
- **Método:** `GET`
- **Ruta:** `/api/articles`
- **Descripción:** Obtiene la lista de artículos.
- **Respuesta:**
```json
{
  "data": [
    {
      "id": 1,
      "title": "Título del artículo",
      "description": "Descripción del artículo"
    }
  ]
}
```

#### **Obtener preguntas frecuentes**
- **Método:** `GET`
- **Ruta:** `/api/faqs`
- **Descripción:** Obtiene la lista de preguntas frecuentes.
- **Respuesta:**
```json
{
  "data": [
    {
      "question": "Pregunta 1",
      "answer": "Respuesta 1"
    }
  ]
}
```

## Errores Comunes
### Error: `Route [roles.index] not defined.`
**Solución:**
1. Verificar que la ruta existe en `routes/web.php`.
2. Ejecutar `php artisan route:list` para comprobar su definición.
3. Limpiar caché:
```bash
php artisan config:clear && php artisan route:clear
```

## Contribución
Si deseas contribuir:
1. Haz un fork del repositorio.
2. Crea una nueva rama:
   ```bash
   git checkout -b feature-nueva
   ```
3. Realiza los cambios y haz un commit:
   ```bash
   git commit -m "Descripción de los cambios"
   ```
4. Envía un pull request.

## Licencia
Este proyecto está bajo la licencia **MIT**. Puedes utilizarlo y modificarlo libremente.

