# Terrasol-PT-Backoffice

## Descripción
Terrasol-PT-Backoffice es un sistema de gestión desarrollado en Laravel 11, diseñado para administrar artículos, usuarios y roles dentro de la plataforma. Utiliza una arquitectura MVC moderna basada en PHP 8.3, con integraciones a bases de datos MySQL y una API REST para consumo de datos.

## Tecnologías Utilizadas
- **Framework:** Laravel 11
- **Lenguaje:** PHP 8.3
- **Base de Datos:** MySQL
- **Frontend:** Blade Templates + JavaScript
- **Autenticación:** Laravel Sanctum
- **Gestor de Dependencias:** Composer & NPM
- **Servidor Web:** Apache / Nginx

## Arquitectura
El sistema sigue el patrón **Modelo-Vista-Controlador (MVC)** para separar la lógica de negocio de la presentación. 
- **Modelo:** Representa los datos y las reglas de negocio.
- **Vista:** Utiliza Blade Templates para la representación visual.
- **Controlador:** Gestiona las solicitudes HTTP y la lógica de la aplicación.

## Diseño de Base de Datos
La base de datos está diseñada con una estructura normalizada, donde:
- **Usuarios:** Gestiona credenciales y permisos.
- **Roles:** Define los permisos dentro del sistema.
- **Artículos:** Contiene información detallada de los artículos publicados.
- **Preguntas Frecuentes (FAQs):** Base de datos para información recurrente.

## Instalación
### 1. Clonar el repositorio
```bash
git clone https://github.com/patriciomelor/Terrasol-PT-Backoffice.git
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

## API y Manejo de Datos
La aplicación cuenta con una API REST para acceder a los datos de forma programática. 

### **Manejo de API en JavaScript**
Se utiliza JavaScript para consumir la API y mostrar los datos en la interfaz.

Ejemplo de carga de configuración general:
```js
async function fetchSettings() {
    try {
        const response = await fetch('http://24.199.83.67/api/settings', {
            method: 'GET',
            headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
        });
        const data = await response.json();
        displaySettings(data);
    } catch (error) {
        console.error('Error al obtener configuración:', error);
    }
}
```

### **Visualización de Artículos**
Los artículos se muestran en tarjetas dinámicas:
```js
async function displayArticles(articles) {
    const container = document.getElementById('articleContainer');
    if (!container) return;
    container.innerHTML = '';
    articles.forEach(article => {
        container.innerHTML += `
            <div class="card">
                <img src="data:image/jpeg;base64,${article.cover_photo}" alt="${article.title}">
                <h5>${article.title}</h5>
                <p>${article.description}</p>
                <a href="article.php?id=${article.id}" class="btn btn-primary">Ver más</a>
            </div>`;
    });
}
```

### **Carga de Preguntas Frecuentes (FAQs)**
```js
async function displayFaqs(faqs) {
    const faqsContainer = document.getElementById('faqAccordion');
    if (!faqsContainer) return;
    faqsContainer.innerHTML = faqs.map((faq, index) => `
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading${index}">
                <button class="accordion-button collapsed" data-bs-toggle="collapse"
                    data-bs-target="#collapse${index}">
                    ${faq.question}
                </button>
            </h2>
            <div id="collapse${index}" class="accordion-collapse collapse">
                <div class="accordion-body">${faq.answer}</div>
            </div>
        </div>`
    ).join('');
}
```

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
- `GET /articles` (Gestín de artículos)
- `POST /articles` (Crear artículo)
- `PUT /articles/{id}` (Actualizar artículo)
- `DELETE /articles/{id}` (Eliminar artículo)

## Errores Comunes y Soluciones
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

