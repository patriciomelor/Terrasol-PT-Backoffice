const phoneInput = document.getElementById('phone');

phoneInput.addEventListener('input', function(event) {
    //reemplaza caracteres no numericos
    event.target.value = event.target.value.replace(/[^0-9]/g, '');
});

document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission behavior
    
    const nombre = document.getElementById('nombre').value;
    const email = document.getElementById('email').value;
    const terminos = document.getElementById('terminos').checked;
    const respuesta = document.getElementById('respuesta').checked;
    const responseMessage = document.getElementById('response-message');

    responseMessage.classList.remove('success', 'error');

    if (!nombre || !email || !terminos) {
        responseMessage.textContent = 'Por favor, complete todos los campos obligatorios y acepte los términos.';
        responseMessage.classList.add('error');
        return false;
    }

    if (!validateEmail(email)) {
        responseMessage.textContent = 'Por favor, ingrese un email válido.';
        responseMessage.classList.add('error');
        return false;
    }

    if (respuesta) {
        responseMessage.textContent = 'Mensaje enviado exitosamente';
        responseMessage.classList.add('success');
    } else {
        responseMessage.textContent = 'Mensaje no enviado, presenta error';
        responseMessage.classList.add('error');
    }

    return true; // Allow the form to submit
});

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}






  