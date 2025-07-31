

<?php
    require 'db.php';

    $data = json_decode(file_get_contents("php://input"), true);
    //Capturamos datos
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    //Verificamos que no hayan campos vacios
    if (!$username || !$password) {
        http_response_code(400);
        echo json_encode(['error' => 'Usuario y contraseña requeridos']);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //Almacenamos los datos en la BD
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);
        echo json_encode(['message' => 'Registro exitoso']);
    } catch (PDOException $e) {     //Si el usuario ya existe
        http_response_code(409);
        echo json_encode(['error' => 'El usuario ya existe']);
    }
?>
