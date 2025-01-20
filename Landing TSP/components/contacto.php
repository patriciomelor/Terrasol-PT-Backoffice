
    <div class="contact-form-wrapper">
      <div class="contact-form-container">
        <form id="contact-form">
          <h2>Contáctanos</h2>
          <div class="form-group mb-3">
            <label for="nombre">Nombre   </label>
            <input type="text" id="nombre" name="nombre" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="apellido">Apellido   </label>
            <input type="text" id="apellido" name="apellido" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="email">Email*   </label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>
          <div class="form-group mb-3">
            <label for="direccion">Dirección   </label>
            <input type="text" id="direccion" name="direccion" class="form-control">
          </div>
          <div class="form-group mb-3">
            <label for="mensaje">Escribe un mensaje   </label>
            <textarea id="mensaje" name="mensaje" class="form-control"></textarea>
          </div>
          <div class="form-check mb-3">
            <input type="checkbox" id="terminos" name="terminos" class="form-check-input" required>
            <label for="terminos" class="form-check-label">Acepto los términos y condiciones</label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Enviar</button>
          <p id="response-message" class="mt-3"></p>
        </form>
      </div>
    </div>

    