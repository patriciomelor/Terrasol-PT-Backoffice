<?php
session_start(); 
var_dump($_SESSION);

// Obtiene el ID del artículo de la URL
$articleId = $_GET['id']; 

// Construye la URL de la API con el ID del artículo
$apiUrl = "http://127.0.0.1:8000/api/articles/" . $articleId;

// Inicializa cURL
$ch = curl_init();

// Configura las opciones de cURL
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer 97jI2Q87CImBAEcNzbS33ucBCyJacSHJSOZW3EMD5db839c0', // Reemplaza con tu token real
    'Content-Type: application/json'
));

// Ejecuta la solicitud cURL
$response = curl_exec($ch);

// Cierra la sesión cURL
curl_close($ch);

// Decodifica la respuesta JSON
$articleData = json_decode($response, true);

// Verifica si la solicitud fue exitosa
if (isset($_SESSION['article'])) { 
    $article = $_SESSION['article']; 
    // **Ahora sí, generamos el HTML después de obtener los datos del artículo**
    ?>
     <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $article['title']; ?></title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="index-page">

    <?php include "components/menu.php"; ?>

    <?php include "components/carousel.php";?>

    <section class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img id="article-image" src="<?php echo $article['cover_photo']; ?>" alt="Imagen del Artículo" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h1 id="article-title" class="display-5"><?php echo $article['title']; ?></h1>
                <p id="article-price" class="text-success fs-4">$<?php echo $article['price']; ?></p>
                <p id="article-description" class="mt-4"><?php echo $article['description']; ?></p>
                <button class="btn btn-primary btn-lg mt-3">Comprar ahora</button>
            </div>
        </div>
    </section>


    <?php include "components/contacto.php"; ?>

    <?php include "components/footer.php"; ?>

    <script src="js/LoadSpinner.js"></script>
    <script src="js/menu.js"></script>
    <script src="js/API.js"></script>
    <script src="js/formContacto.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

    <?php
} else {
    // Si hay un error al obtener los datos, mostramos un mensaje de error
    echo "Error al cargar los datos del artículo. Es posible que la información no esté disponible o que la sesión haya expirado."; 
}
?>