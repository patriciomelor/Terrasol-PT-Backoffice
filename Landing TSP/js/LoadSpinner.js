document.addEventListener('DOMContentLoaded', function() {
    const loadingOverlay = document.getElementById('loading-overlay');
  
    // Mostrar el overlay al iniciar la carga
    loadingOverlay.style.display = 'flex';
  
    // Simular la carga de datos (reemplaza esto con tus llamadas a la API)
    Promise.all([
      fetchData('http://127.0.0.1:8000/api/faqs', displayFaqs),
      fetchData('http://127.0.0.1:8000/api/settings', displayMissionAndVision),
      fetchData('http://127.0.0.1:8000/api/articles', displayArticles)
    ])
    .then(() => {
      // Ocultar el overlay cuando todas las APIs hayan respondido
      loadingOverlay.style.display = 'none';
    })
    .catch(error => {
      console.error('Error al cargar los datos:', error);
      // Manejar el error, por ejemplo, mostrar un mensaje al usuario
      loadingOverlay.innerHTML = '<p>Error al cargar los datos.</p>';
    });
  });