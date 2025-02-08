// Variables globales para token y caché
const token = '97jI2Q87CImBAEcNzbS33ucBCyJacSHJSOZW3EMD5db839c0'; // Reemplaza con tu token
const regionCache = {};
const comunaCache = {};
let articles = []; // Variable global para almacenar los artículos

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
      address: 'address'
    };

    Object.entries(elements).forEach(([key, id]) => {
      const element = document.getElementById(id);
      if (element) element.innerHTML = data[key] || `No se ha definido ${key.replace('_', ' ')}.`;
    });
  } else {
    console.error('No se pudieron cargar los datos de misión y visión.');
  }
}

async function getRegionName(regionId) {
  if (!regionId) return 'Desconocida';
  if (regionCache[regionId]) return regionCache[regionId];
  try {
    const response = await fetch(`https://24.199.83.67/api/regions/${regionId}`, {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });
    if (!response.ok) throw new Error(`Error HTTP ${response.status}`);
    const regionData = await response.json();
    const regionName = regionData.data?.nombre || 'Desconocida';
    regionCache[regionId] = regionName;
    return regionName;
  } catch (error) {
    console.error(`Error al obtener la región con ID ${regionId}:`, error);
    return 'Desconocida';
  }
}

async function getComunaName(comunaId) {
  if (!comunaId) return 'Desconocida';
  if (comunaCache[comunaId]) return comunaCache[comunaId];
  try {
    const response = await fetch('https://24.199.83.67/api/comunas', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });
    if (!response.ok) throw new Error(`Error HTTP ${response.status}`);
    const comunasData = await response.json();
    const comuna = comunasData.data.find(comuna => comuna.id === comunaId);
    const comunaName = comuna ? comuna.nombre : 'Desconocida';
    comunaCache[comunaId] = comunaName;
    return comunaName;
  } catch (error) {
    console.error(`Error al obtener la comuna con ID ${comunaId}:`, error);
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
    const imageUrl = article.cover_photo;

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

// 🛠️ Función corregida para mostrar preguntas frecuentes
function displayFaqs(faqs) {
  const faqsContainer = document.getElementById('faqAccordion');
  if (!faqsContainer) {
    console.error('El contenedor #faqAccordion no existe en el DOM.');
    return;
  }

  if (!faqs || !Array.isArray(faqs)) {
    faqsContainer.innerHTML = '<p>No se pudieron cargar las preguntas frecuentes.</p>';
    return;
  }

  faqsContainer.innerHTML = faqs.map((faq, index) => `
    <div class="accordion-item item-faq">
      <h2 class="accordion-header" style="font-size:15px" id="heading${index}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapse${index}" aria-expanded="false" aria-controls="collapse${index}">
          <h3>${faq.question}</h3>
        </button>
      </h2>
      <div id="collapse${index}" class="accordion-collapse collapse answer" 
        aria-labelledby="heading${index}" data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          ${faq.answer || faq.respuesta || 'No hay respuesta disponible.'}
        </div>
      </div>
    </div>
  `).join('');
}

// ✅ Llamada a la API de FAQs dentro de init()
async function init() {
  try {
    // Carga de configuraciones
    const settingsResponse = await fetch('https://24.199.83.67/api/settings', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });
    const settings = await settingsResponse.json();
    displaySettings(settings);

    // Carga de FAQs
    const faqsResponse = await fetch('https://24.199.83.67/api/faqs', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });
    const faqsData = await faqsResponse.json();
    displayFaqs(faqsData.data || []);

    // Carga de artículos
    const articlesResponse = await fetch('https://24.199.83.67/api/articles', {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });
    const articlesData = await articlesResponse.json();
    articles = articlesData.data || [];
    displayArticles(articles);
  } catch (error) {
    console.error('Error al cargar los datos:', error);
  }
}

// Llamada a init cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
  init();
});
