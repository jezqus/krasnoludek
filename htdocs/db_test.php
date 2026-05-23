<?php
// db_test.php - simple MariaDB connection test
$host = 'db';
$user = 'root';
$pass = 'admin';
$port = 3306;

// Initialize mysqli and attempt connection without selecting a database
$mysqli = mysqli_init();
if (!$mysqli) {
    http_response_code(500);
    echo "mysqli_init failed";
    exit;
}

if (!@$mysqli->real_connect($host, $user, $pass, null, $port)) {
    http_response_code(500);
    echo "Connection failed: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
    exit;
}

echo "Connected to MariaDB successfully.";
$mysqli->close();
