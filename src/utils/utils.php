<?php
// src/utils/utils.php

function validarEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function generarHashSeguro($cadena)
{
    return password_hash($cadena, PASSWORD_BCRYPT);
}

function verificarSesion()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['id_protectora'])) {
        header('Location: ' . BASE_URL . 'index.php?page=login');
        exit();
    }

    $id_protectora = $_SESSION['id_protectora'] ?? null;

    if ($id_protectora === null) {
        echo "<script>alert('No se ha encontrado el ID de la protectora en la sesión.');</script>";
        exit;
    }

    return $id_protectora;
}

function validarNoVacio($valor)
{
    return !empty($valor);
}

function emailExiste($conn, $email)
{
    $sql = "SELECT 1 FROM protectoras WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    return $stmt->fetchColumn() > 0;
}
