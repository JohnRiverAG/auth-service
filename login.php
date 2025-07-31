

<?php
    require 'db.php';

    //Capturamos los datos ingresados
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    //Verificamos que no hayan campos vacios
    if (!$username || !$password) {
        http_response_code(400);
        echo json_encode(['error' => 'Usuario y contraseña requeridos']);
        exit;
    }

    //Corroboramos ingresados con los almacenados
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    //COmunicamos el resultado de la consulta
    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(['message' => 'Autenticación satisfactoria']);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Error en la autenticación']);
    }
?>
