<?php

    function subirImagen($archivo, $directorio, $prefijo = '') {
        // Validación y configuración del directorio de subida
        $uploadDir = $directorio;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generar nombre único para el archivo
        $fileName = $prefijo . uniqid() . '.' . pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $filePath = $uploadDir . $fileName;

        // Mostrar información de la imagen y el directorio para depuración
        var_dump($archivo);
        var_dump($filePath);
        
        // Validar el tipo de archivo (puedes agregar más tipos si es necesario)
        $validTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($archivo['type'], $validTypes)) {
            return ['error' => 'Tipo de archivo no permitido.'];
        }

        // Intentar mover el archivo
        if (move_uploaded_file($archivo['tmp_name'], $filePath)) {
            return ['success' => $fileName];
        }

        return ['error' => 'Error al subir la imagen.'];
    }

?>
