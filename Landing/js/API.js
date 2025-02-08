// Variables globales para token y caché
const token = '97jI2Q87CImBAEcNzbS33ucBCyJacSHJSOZW3EMD5db839c0'; // Reemplaza con tu token
const regionCache = {};
const comunaCache = {};
let articles = []; // Asegurar que es un array

function displaySettings(data) {
    if (data) {
        const elements = {
            mission: 'mission',
            vision: 'vision',
            about_us: 'nosotros',
            site_name: 'site_name',
            site_description: 'site_description',
            contact_phone: 'contact_phone',
            contact_email: 'contact_email',
            address: 'address',
        };

        Object.entries(elements).forEach(([key, id]) => {
            const element = document.getElementById(id);
            if (element) element.innerHTML = data[key] || `No se ha definido ${key.replace('_', ' ')}.`;
        });
    } else {
        console.error('No se pudieron cargar los datos de configuración.');
    }
}

async function getRegionName(regionId) {
    if (!regionId) return 'Desconocida';
    if (regionCache[regionId]) return regionCache[regionId];
    try {
        const response = await fetch(`http://24.199.83.67/api/regions/${regionId}`, {
            method: 'GET',
            headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
        });
        if (!response.ok) throw new Error(`Error HTTP ${response.status}`);
        const regionData = await response.json();
        const regionName = regionData.data?.nombre || 'Desconocida';
        regionCache[regionId] = regionName;
        return regionName;
    } catch (error) {
        console.error(`Error al obtener la región ${regionId}:`, error);
        return 'Desconocida';
    }
}

async function displayArticles(articles) {
    const container = document.getElementById('articleContainer');
    if (!container) {
        console.error('El contenedor #articleContainer no existe en el DOM.');
        return;
    }

    container.innerHTML = '';

    for (const article of articles) {
        const regionName = article.region ? await getRegionName(article.region) : 'Desconocida';
        const comunaName = article.city || 'Desconocida';
        const streetName = article.street || 'Desconocida';
        const imageUrl = article.cover_photo || '';

        const articleCard = document.createElement('div');
        articleCard.className = 'card mb-3';
        articleCard.innerHTML = `
            <div class="bg-label-primary border border-bottom-0 border-label-primary position-relative team-image-box">
                <img src="data:image/jpeg;base64,${imageUrl}" class="card-img-top" alt="${article.title}">
            </div>
            <div class="card-body h-100">
                <h5 class="card-title">${article.title}</h5>
                <p class="card-text-articles">${article.description}</p>
                <p class="card-text"><small class="text-muted">Región: ${regionName}, Comuna: ${comunaName}</small></p>
                <p class="card-text"><small class="text-muted">Calle: ${streetName}</small></p>
                <a href="article.php?id=${article.id}" class="btn btn-primary" onclick="setArticleSession(${article.id})">Ver más</a>
            </div>
        `;

        container.appendChild(articleCard);
    }
}

function setArticleSession(articleId) {
    const article = articles.find(article => article.id === articleId);
    sessionStorage.setItem('article', JSON.stringify(article));
}

function displayFaqs(faqs) {
  console.log('FAQs recibidos:', faqs); // Debug para ver si los FAQs llegan

  const faqsContainer = document.getElementById('faqAccordion');
  if (!faqsContainer) {
      console.error('El contenedor #faqAccordion no existe en el DOM.');
      return;
  }

  if (!faqs || !Array.isArray(faqs) || faqs.length === 0) {
      console.warn('No hay FAQs disponibles.');
      faqsContainer.innerHTML = '<p>No se encontraron preguntas frecuentes.</p>';
      return;
  }

  faqsContainer.innerHTML = faqs.map((faq, index) => `
      <div class="accordion-item">
          <h2 class="accordion-header" id="heading${index}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapse${index}" aria-expanded="false" aria-controls="collapse${index}">
                  ${faq.question}
              </button>
          </h2>
          <div id="collapse${index}" class="accordion-collapse collapse" aria-labelledby="heading${index}" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                  ${faq.answer || faq.respuesta || 'No hay respuesta disponible.'}
              </div>
          </div>
      </div>
  `).join('');

  console.log('FAQs renderizados en el DOM');
}

// Función init
async function init() {
    try {
        // Carga de configuraciones
        const settingsResponse = await fetch('http://24.199.83.67/api/settings', {
            method: 'GET',
            headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
        });
        const settings = await settingsResponse.json();
        displaySettings(settings);

        // Carga de artículos
        const articlesResponse = await fetch('http://24.199.83.67/api/articles', {
            method: 'GET',
            headers: { 'Authorization': `Bearer ${token}`, 'Content-Type': 'application/json' },
        });
        const articlesData = await articlesResponse.json();
        articles = Array.isArray(articlesData.data) ? articlesData.data : [];
        displayArticles(articles);

        // Carga de FAQs
        const faqsResponse = await fetch('http://24.199.83.67/api/faqs', {
          method: 'GET',
          headers: {
              'Authorization': `Bearer ${token}`,
              'Content-Type': 'application/json',
          },
      });

      if (!faqsResponse.ok) throw new Error(`Error HTTP ${faqsResponse.status}`);

      const faqsData = await faqsResponse.json();
      console.log('Respuesta de la API (FAQs):', faqsData); // Verifica cómo llega la respuesta

      const faqs = faqsData.data || faqsData; // Si `data` no existe, usa el objeto directamente
      console.log('FAQs procesados:', faqs);

      displayFaqs(faqs);
  } catch (error) {
      console.error('Error al cargar los FAQs:', error);
  }
}

// Llamada a init
document.addEventListener('DOMContentLoaded', () => {
    init();
});
