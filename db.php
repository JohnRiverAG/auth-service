

<?php
    //Creamos los datos para la conexión a la BD
    $host = 'localhost';
    $db   = 'auth_db';
    $user = 'root';
    $pass = 'main';
    $charset = 'utf8mb4';   //Para pasar el valor de la variable a una cadena de este tipo

    //Preparamos la conexión usando php's PDO
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    //Tratamos de conectarnos a la BD
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error de conexión a la base de datos']);
        exit;
    }
?>
