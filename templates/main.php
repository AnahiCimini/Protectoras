<!-- ../templates/main.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aplicación de Adopción de Animales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public_html/assets/css/customStyle.css">
    <link rel="stylesheet" href="../public_html/assets/css/templates.css">
    <link rel="stylesheet" href="../public_html/assets/css/forms.css">
    <link rel="stylesheet" href="../public_html/assets/css/slider.css">
    <link rel="stylesheet" href="../public_html/assets/css/buscadores.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <script src="../public_html/assets/js/customScript.js" defer> </script>
    <script src="../public_html/assets/js/slider.js" defer> </script>
    <script src="../public_html/assets/js/registro.js" defer> </script>
    <script src="../public_html/assets/js/buscadores.js" defer> </script>
    
</head>
<body>
     <?php include 'header.php'; ?> 

    
    <main>
        <?php include $view; ?>
    </main>
    
    <?php include 'footer.php'; ?>
</body> 
</html>
