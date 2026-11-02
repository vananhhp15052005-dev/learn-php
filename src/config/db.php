<?php

$host = 'db';
$database = getenv('MYSQL_DATABASE');
$username = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');

try {
    $conn = new mysqli(
        $host,
        $username,
        $password,
        $database
    );

    $conn->set_charset('utf8mb4');

} catch (mysqli_sql_exception $e) {
    die('Kết nối cơ sở dữ liệu thất bại: ' . $e->getMessage());
}

?>
