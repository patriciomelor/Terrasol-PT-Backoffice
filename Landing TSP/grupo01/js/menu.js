document.addEventListener('DOMContentLoaded', function() {
    // Función para gestionar la clase 'active' en los enlaces de navegación
    var links = document.querySelectorAll('.nav-link');
    var currentUrl = window.location.href;

    links.forEach(function(link) {
        if (currentUrl.includes(link.getAttribute('href'))) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });

    // Función para añadir la clase 'scrolled' a la barra de navegación al hacer scroll
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 0) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
});

