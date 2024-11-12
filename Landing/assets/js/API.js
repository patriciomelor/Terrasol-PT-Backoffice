document.addEventListener('DOMContentLoaded', function() {
    const token = '97jI2Q87CImBAEcNzbS33ucBCyJacSHJSOZW3EMD5db839c0';  // Sustituye este valor por tu Bearer Token real

    // Función para manejar las solicitudes a la API
    function fetchData(url, callback) {
        fetch(url, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => callback(data))
        .catch(error => {
            console.error('Error fetching data:', error);
            callback(null); // Llamamos a la función de callback con null en caso de error
        });
    }

    // Mostrar misión y visión
    function displayMissionAndVision(data) {
        if (data) {
            document.getElementById('mission').innerHTML = data.mission || 'No se ha definido la misión.';
            document.getElementById('vision').innerHTML = data.vision || 'No se ha definido la visión.';
            document.getElementById('nosotros').innerHTML = data.about_us || 'No se ha definido la Sobre nosotros.';
            document.getElementById('site_name').innerHTML = data.site_name || 'No se ha definido El titulo.';
            document.getElementById('site_description').innerHTML = data.site_description || 'No se ha definido El subtitulo.';
        } else {
            document.getElementById('mission').textContent = 'No se pudo cargar la misión.';
            document.getElementById('vision').textContent = 'No se pudo cargar la visión.';
            document.getElementById('nosotros').textContent = 'No se pudo cargar la Sobre Nosotros.';

            document.getElementById('site_name').textContent =  'No se pudo cargar  El titulo.';
            document.getElementById('site_description').textContent= 'No se pudo cargar  El subtitulo.';
        }
    }

    // Mostrar artículos
    function displayArticles(data) {
        const articlesContainer = document.getElementById('articles-container');

        // Verifica que la respuesta contenga los artículos en 'data' y que sea un array
        if (data && data.data && Array.isArray(data.data)) {
            // Limpiar el contenedor antes de agregar nuevos artículos
            articlesContainer.innerHTML = '';

            data.data.forEach(article => {
                // Crear el HTML de cada tarjeta
                const card = document.createElement('div');
                card.classList.add('col-lg-3', 'col-sm-6');

                // Crear el contenido de la tarjeta
                card.innerHTML = `
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-primary border border-bottom-0 border-label-primary position-relative team-image-box">
                            <!-- Mostrar la imagen de portada -->
                            ${article.photos.length > 0 ? 
                                `<img src="data:image/jpeg;base64,${article.photos[0]}" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="Cover Photo">` : 
                                '<img src="default-cover.jpg" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="Cover Photo">'
                        
            
                            }
                        </div>
                        <div class="card-body border border-top-0 border-label-primary text-center">
                            <h5 class="card-title mb-0">${article.title}</h5>
                            <p class="text-muted mb-0">${article.square_meters} m² / ${article.constructed_meters} m²</p>
                            <p class="text-muted mb-0">${article.region.nombre}, ${article.city.nombre}, ${article.street}</p>
                        </div>
                    </div>
                `;

                // Agregar la tarjeta al contenedor
                articlesContainer.appendChild(card);
            });
        } else {
            articlesContainer.innerHTML = '<p>No se pudieron cargar los artículos.</p>';
        }
    }

    // Obtener y mostrar la misión y visión
    fetchData('http://127.0.0.1:8000/api/settings', displayMissionAndVision);
    
    // Obtener y mostrar los artículos
    fetchData('http://127.0.0.1:8000/api/articles', displayArticles);
});
