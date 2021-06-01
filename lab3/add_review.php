<?php
    $mysqli = new mysqli("localhost", "f0522592_flow", "flow", "f0522592_flow");
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к БД";
    }

    $name = $_GET['name'];
    $email = $_GET['email'];
    $review = $_GET['review'];

    $result = $mysqli->query(
        "INSERT INTO reviews SET name='$name', email='$email', message='$review'"
    );
?>