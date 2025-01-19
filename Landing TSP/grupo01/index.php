<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/menu.css" >
    <link rel="stylesheet" href="css/footer.css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="index-page">
    <?php include "components/menu.php"; ?>

    <section class="Inicio" id="Inicio">
    <!-- Slider con imágenes -->
  
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

          <div class="carousel-item active">
             <img src="img/img10.jpg" class="d-block w-100" alt="img1">
             <div class="carousel-caption">
              <h2 class="carousel-title">Construye tu refugio en un entorno natural privilegiado</h2>
              </div>
          </div>

          <div class="carousel-item">
              <img src="img/img8.jpg" class="d-block w-100" alt="img2">
              <div class="carousel-caption">
              <h2 class="carousel-title">Un oasis personal: naturaleza, paz y comodidad a tu alcance</h2>
              </div>
          </div>

          <div class="carousel-item">
              <img src="img/img9.png" class="d-block w-100" alt="img3">
              <div class="carousel-caption">
              <h2 class="carousel-title">Vive el sueño de la vida rural: tranquilidad y aire puro en cada parcela</h2>
              </div>
          </div>

          <div class="carousel-item">
             <img src="img/img7.jpg" class="d-block w-100" alt="img4">
             <div class="carousel-caption">
              <h2 class="carousel-title">Invierte en calidad de vida: vive rodeado de paisajes impresionantes</h2>
              </div>
          </div>

        </div>
    
        <div class="carousel-title-container">
          <img src="img/logoTerrasolParcelasTransparent.png" alt="Terrasol Parcelas">
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      </section>

      <section class="Nosotros" id="Nosotros">
      <?php include "about.php"; ?>
      </section>

      <section class="Parcelas" id="Parcelas">
      <?php include "parcelas.php"; ?>
      </section>

      <section class="Terrenos" id="Terrenos">
      <?php include "terrenos.php"; ?>
      </section>

      <section class="Casa" id="Casa">
      <?php include "casas.php"; ?>
      </section>

      <section class="Preguntas" id="Preguntas">
      <?php include "preguntas.php"; ?>
      </section>

      <section class="Contacto" id="Contacto">
      <?php include "contacto.php"; ?>
      </section>

      <!-- Footer -->
      <?php include "components/footer.php"; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="js/menu.js"></script>
        <script src="js/funciones.js"></script>

  
    </body>
    
</body>
</html>