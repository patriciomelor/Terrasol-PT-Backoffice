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
        // Manejar el error, por ejemplo, mostrar un mensaje al usuario
      });
  }

  function displayMissionAndVision(data) {
    if (data) {
      const missionElement = document.getElementById('mission');
      const visionElement = document.getElementById('vision');
      const nosotrosElement = document.getElementById('nosotros');
      const siteNameElement = document.getElementById('site_name');
      const siteDescriptionElements = document.querySelectorAll('.site_description');
  
      if (missionElement) missionElement.innerHTML = data.mission || 'No se ha definido la misión.';
      if (visionElement) visionElement.innerHTML = data.vision || 'No se ha definido la visión.';
      if (nosotrosElement) nosotrosElement.innerHTML = data.about_us || 'No se ha definido la Sobre nosotros.';
      if (siteNameElement) siteNameElement.innerHTML = data.site_name || 'No se ha definido El titulo.';
      siteDescriptionElements.forEach(element => {
        element.innerHTML = data.site_description || 'No se ha definido El subtitulo.';
      });
    } else {
      console.error('No se pudieron cargar los datos de misión y visión.');
    }
  }
  // Mostrar artículos
  function displayArticles(data) {
    const articlesContainer = document.getElementById('articles-container');

    if (data && data.data && Array.isArray(data.data)) {
      articlesContainer.innerHTML = ''; // Limpiar el contenedor
      data.data.forEach(article => {
        if (article.region && article.city) {
          console.log("Region ID:", article.region); // Imprimir el ID de la región
          console.log("Comuna ID:", article.city); // Imprimir el ID de la comuna

          Promise.all([
            getRegionName(article.region), // Obtener el nombre de la región
            getComunaName(article.city)    // Obtener el nombre de la comuna
          ])
            .then(([regionName, comunaName]) => {
              console.log("Region Name:", regionName); // Imprimir el nombre de la región
              console.log("Comuna Name:", comunaName); // Imprimir el nombre de la comuna

              // Obtener las características del artículo
              const caracteristicas = article.caracteristicas || [];

              // Construir el HTML de la descripción 
              let descriptionHTML = `<p class="card-text">${article.description.substring(0, 150)}...</p>`;
              // Usar comunaName en lugar de cityName
              descriptionHTML += `<p class="card-text">${regionName}, ${comunaName}, ${article.street}</p>`;

              // Agregar los iconos de características
              if (caracteristicas.length > 0) {
                descriptionHTML += '<div class="caracteristicas">';
                caracteristicas.forEach(caracteristica => {
                  descriptionHTML += `<span><i class="${caracteristica.icono}"></i> ${caracteristica.nombre}</span>`;
                });
                descriptionHTML += '</div>';
              }

              // Crear el HTML de la card
              const card = document.createElement('div');
              card.classList.add('col-lg-4', 'col-sm-6');
              card.innerHTML = `
                <div class="col">
                  <div class="card">
                    <div class="bg-label-primary border border-bottom-0 border-label-primary position-relative team-image-box">
                      ${article.cover_photo ?
                  `<img src="data:image/jpeg;base64,${article.cover_photo}" class="card-img-top" alt="Cover Photo">` :
                  '<img src="default-cover.jpg" class="card-img-top" alt="Cover Photo">'
                }
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">${article.title}</h5>
                      ${descriptionHTML}
                    </div>
                    <div class="btn-center">
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#articleModal" onclick="openModal(${article.id})">
                        Ver más
                      </button>
                    </div>
                  </div>
                </div>
              `;

              // Agregar la card al contenedor
              articlesContainer.appendChild(card);
            })
            .catch(error => {
              // Manejar el error
              console.error('Error al obtener la región o comuna:', error);
            });
        } else {
          // Manejar el caso en que no hay región o ciudad
          console.warn("Artículo sin región o ciudad:", article);
        }
      });
    } else {
      articlesContainer.innerHTML = '<p>No se pudieron cargar los artículos.</p>';
    }
  }
  // Trae Comunas
  // Obtener el nombre de la comuna
  function getComunaName(comunaId) {
    return new Promise((resolve, reject) => {
      fetch(`http://127.0.0.1:8000/api/comunas`, {
        method: 'GET',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        }
      })
        .then(response => {
          if (!response.ok) {
            throw new Error(`Error al obtener las comunas: ${response.status} ${response.statusText}`);
          }
          return response.json();
        })
        .then(comunasData => {
          const comuna = comunasData.data.find(comuna => comuna.id === comunaId);
          const comunaName = comuna ? comuna.nombre : 'Desconocida';
          resolve(comunaName);
        })
        .catch(error => {
          console.error('Error al obtener el nombre de la comuna:', error);
          resolve('Desconocida');
        });
    });
  }
  // Obtener el nombre de la región
  function getRegionName(regionId) {
    return new Promise((resolve, reject) => {
      fetch(`http://127.0.0.1:8000/api/regions/${regionId}`, {
        method: 'GET',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json'
        }
      })
        .then(response => {
          if (!response.ok) {
            throw new Error(`Error al obtener la región: ${response.status} ${response.statusText}`);
          }
          return response.json();
        })
        .then(regionData => {
          const regionName = regionData.data.nombre || 'Desconocida';
          resolve(regionName);
        })
        .catch(error => {
          console.error('Error al obtener el nombre de la región:', error);
          resolve('Desconocida');
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
  //Trae las preguntas frecuentes
  function displayFaqs(faqs) {
    const faqsContainer = document.getElementById('faqAccordion');
    if (faqsContainer) {
      if (faqs && Array.isArray(faqs)) {
        faqsContainer.innerHTML = ''; // Limpiar el contenedor

        faqs.forEach((faq, index) => {
          const faqItem = `
                <div class="accordion-item item-faq">
                <div class="question">
                  <h2 class="accordion-header"style="font-size:15px" id="heading${index}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}" aria-expanded="false" aria-controls="collapse${index}">
                      <h3>${faq.question}</h3>
                    </button>
                  </h2>
                  </div>
                  <div id="collapse${index}" class="accordion-collapse collapse answer" aria-labelledby="heading${index}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                      ${faq.answer}
                    </div>
                  </div>
                </div>
              `;
          faqsContainer.appendChild(document.createRange().createContextualFragment(faqItem));
        });
      } else {
        faqsContainer.innerHTML = '<p>No se pudieron cargar las preguntas frecuentes.</p>';
      }
    } else {
      console.error('El contenedor #faqAccordion no existe en el DOM.');
    }
  }
  fetchData('http://127.0.0.1:8000/api/faqs', displayFaqs);

  // Obtener y mostrar la misión y visión
  fetchData('http://127.0.0.1:8000/api/settings', displayMissionAndVision);

  // Obtener y mostrar los artículos
  fetchData('http://127.0.0.1:8000/api/articles', displayArticles);

  // Obtener todas las preguntas (elementos con la clase "question")
  const questions = document.querySelectorAll('.question');

  // Agregar un event listener a cada pregunta
  questions.forEach(question => {
    question.addEventListener('click', () => {
      // Encontrar el elemento "answer" que corresponde a la pregunta
      const answer = question.nextElementSibling;
      const parrafo = answer.querySelector('p'); // Obtener el párrafo dentro de la respuesta
      const btnDropdown = question.querySelector('.more'); // Obtener el botón dentro de la pregunta

      // Alternar la visibilidad y la altura de la respuesta
      if (answer.style.height === '0px' || answer.style.height === '') {
        const altoParrafo = parrafo.clientHeight; // Obtener la altura del párrafo
        answer.style.height = `${altoParrafo}px`;
        question.style.marginBottom = '10px';
        btnDropdown.innerHTML = '<i>-</i>';
      } else {
        answer.style.height = '0px';
        question.style.marginBottom = '0px';
        btnDropdown.innerHTML = '<i>+</i>';
      }
    });
  });

});