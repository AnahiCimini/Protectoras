<?php
    require_once PROJECT_ROOT . '/config/config.php';
?>

<!-- ../templates/main.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicación de Adopción de Animales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/customStyle.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/templates.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/formsYPerfiles.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/animales.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/slider.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/buscadores.css">
    
</head>
<body>
     <?php include 'header.php'; ?> 

    
    <main>
        <?php include $view; ?>
    </main>
    
    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/customScript.js"> </script>
    <script src="<?php echo BASE_URL; ?>assets/js/editorAnimalesScript.js"> </script>
    <script src="<?php echo BASE_URL; ?>assets/js/registroScript.js"> </script>
    <script src="<?php echo BASE_URL; ?>assets/js/sliderScript.js"> </script>
</body>
</html>
