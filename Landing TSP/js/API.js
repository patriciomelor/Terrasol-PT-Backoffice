   // Debe estar en el ámbito global, no dentro de otra función
   function openModal(articleId) {
    // Obtener los datos del artículo con la ID correspondiente (puedes obtener estos datos de la API si es necesario)
    const article = data.data.find(article => article.id === articleId);
    
    if (article) {
        // Actualizar los campos del modal con los datos del artículo
        document.getElementById('modal-title').textContent = article.title;
        document.getElementById('modal-description').textContent = article.description;
        document.getElementById('modal-size').textContent = `${article.square_meters} m² / ${article.constructed_meters} m²`;
        document.getElementById('modal-location').textContent = `${regionName}, ${cityName}, ${article.street}`;
        
        // Si hay una imagen de portada, mostrarla
        const coverImage = article.photos.length > 0 ? `data:image/jpeg;base64,${article.photos[0]}` : 'default-cover.jpg';
        document.getElementById('modal-image').src = coverImage;

        // Mostrar las comunas si están disponibles
        getComunasForRegion(article.region).then(comunas => {
            const comunaList = document.getElementById('modal-communes');
            comunaList.innerHTML = ''; // Limpiar las comunas previas si existen

            if (comunas.length > 0) {
                comunas.forEach(comuna => {
                    const comunaItem = document.createElement('li');
                    comunaItem.textContent = comuna.nombre; // Mostrar el nombre de la comuna
                    comunaList.appendChild(comunaItem);
                });
            } else {
                const noComunasItem = document.createElement('li');
                noComunasItem.textContent = 'No hay comunas asociadas a esta región.';
                comunaList.appendChild(noComunasItem);
            }
        });
         // Agregar inert al body (o el contenedor principal de la página)
         document.body.setAttribute('inert', 'true');
        
         // Abrir el modal (asumido que usas Bootstrap o algo similar)
         const modal = new bootstrap.Modal(document.getElementById('articleModal'));
         modal.show();
 
         // Al cerrar el modal, quitar el inert para permitir la interacción con el contenido
         document.getElementById('articleModal').addEventListener('hidden.bs.modal', function () {
             document.body.removeAttribute('inert');
         });
    }
}

document.addEventListener('DOMContentLoaded', function () {
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
            document.getElementById('site_name').textContent = 'No se pudo cargar  El titulo.';
            document.getElementById('site_description').textContent = 'No se pudo cargar  El subtitulo.';
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
                getRegionAndCityNames(article.region, article.city).then(names => {
                    const regionName = names.regionName || 'Desconocida';
                    const cityName = names.cityName || 'Desconocida';
                    const comunaName = names.comunaName || 'Desconocida'; // Agregado para mostrar la comuna

                    // Crear el HTML de cada tarjeta
                    const card = document.createElement('div');
                    card.classList.add('col-lg-4', 'col-sm-6');
                    card.innerHTML = `
                    <div class="card mt-3 mt-lg-0 shadow-none">
                        <div class="bg-label-primary border border-bottom-0 border-label-primary position-relative team-image-box">
                            ${article.photos.length > 0 ?
                            `<img src="data:image/jpeg;base64,${article.photos[0]}" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="Cover Photo">` :
                            '<img src="default-cover.jpg" class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="Cover Photo">'
                        }
                        </div>
                        <div class="card-body border border-top-0 border-label-primary text-center">
                            <h5 class="card-title mb-0">${article.title}</h5>
                            <p class="text-muted mb-0">${article.square_meters} m² / ${article.constructed_meters} m²</p>
                            <p class="text-muted mb-0">${regionName}, ${comunaName}, ${article.street}</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#articleModal" onclick="openModal(${article.id})">
                                Ver más
                            </button>
                        </div>
                    </div>
                `;
                    // Agregar la tarjeta al contenedor
                    articlesContainer.appendChild(card);
                });
            });
        } else {
            articlesContainer.innerHTML = '<p>No se pudieron cargar los artículos.</p>';
        }
    }
    // relaciona Regiones y comunas
    function getRegionAndCityNames(regionId, cityId) {
        return new Promise((resolve, reject) => {
            // Primero, obtener la región
            fetch(`http://127.0.0.1:8000/api/regions/${regionId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(regionData => {
                    const regionName = regionData ? regionData.nombre : 'Desconocida';

                    // Luego, obtener las comunas asociadas a la región
                    fetch(`http://127.0.0.1:8000/api/regions/${regionId}/communes`, {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(res => res.json())
                        .then(cityData => {
                            const cityName = cityData ? cityData.find(city => city.id === cityId)?.nombre : 'Desconocida';

                            // Encontrar la comuna que corresponde al cityId
                            const comunaName = cityData ? cityData.find(comuna => comuna.id == cityId)?.nombre : 'Desconocida';

                            resolve({ regionName, cityName, comunaName });
                        })
                        .catch(error => {
                            console.error('Error fetching city data:', error);
                            resolve({ regionName, cityName: 'Desconocida', comunaName: 'Desconocida' });
                        });
                })
                .catch(error => {
                    console.error('Error fetching region data:', error);
                    resolve({ regionName: 'Desconocida', cityName: 'Desconocida', comunaName: 'Desconocida' });
                });
        });
    }
    //trae las comunas vinculadas a cada region
    function getComunasForRegion(regionId) {
        return new Promise((resolve, reject) => {
            fetch(`http://127.0.0.1:8000/api/regions/${regionId}/communes`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    resolve(data); // Devolvemos las comunas
                })
                .catch(error => {
                    console.error('Error fetching communes:', error);
                    resolve([]); // En caso de error, devolvemos un array vacío
                });
        });
    }
    // Mostrar las preguntas frecuentes
    function displayFaqs(faqs) {
        const faqsContainer = document.getElementById('faqAccordion'); 
    
        if (faqsContainer) {
            if (faqs && Array.isArray(faqs)) {
                faqsContainer.innerHTML = ''; // Limpiar el contenedor
    
                faqs.forEach(faq => {
                    const faqItem = document.createElement('div');
                    faqItem.classList.add('item-faq'); // Agregar la clase 'item-faq'
                    faqItem.innerHTML = `
                        <div class="question">
                            <h3>${faq.question}<span>P</span></h3> 
                            <div class="more"><i>+</i></div>
                        </div>
                        <div class="answer">
                            <p>${faq.answer}<span>R</span></p> 
                        </div>
                    `;
                    faqsContainer.appendChild(faqItem); 
                });
    
                // (Opcional) Si necesitas agregar la funcionalidad de expandir/colapsar las preguntas, 
                // agrega el código aquí.
    
            } else {
                faqsContainer.innerHTML = '<p>No se pudieron cargar las preguntas frecuentes.</p>';
            }
        } else {
            console.error('El contenedor #faqAccordion no existe en el DOM.');
        }
    }

    // Obtener y mostrar las preguntas frecuentes
    fetchData('http://127.0.0.1:8000/api/faqs', displayFaqs);

    // Obtener y mostrar la misión y visión
    fetchData('http://127.0.0.1:8000/api/settings', displayMissionAndVision);

    // Obtener y mostrar los artículos
    fetchData('http://127.0.0.1:8000/api/articles', displayArticles);

    let question = document.querySelectorAll('.question');
let btnDropdown = document.querySelectorAll('.question .more')
let answer = document.querySelectorAll('.answer');
let parrafo = document.querySelectorAll('.answer p');

for ( let i = 0; i < btnDropdown.length; i ++ ) {

    let altoParrafo = parrafo[i].clientHeight;
    let switchc = 0;

    btnDropdown[i].addEventListener('click', () => {

        if ( switchc == 0 ) {

            answer[i].style.height = `${altoParrafo}px`;
            question[i].style.marginBottom = '10px';
            btnDropdown[i].innerHTML = '<i>-</i>';
            switchc ++;

        }

        else if ( switchc == 1 ) {

            answer[i].style.height = `0`;
            question[i].style.marginBottom = '0';
            btnDropdown[i].innerHTML = '<i>+</i>';
            switchc --;

        }

    })

}
});
