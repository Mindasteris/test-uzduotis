<?php
    // Database info
    $host = 'localhost';
    $dbname = 'uzduotis';
    $user = 'root';
    $password = '';

    // Connect DB
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";

    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }