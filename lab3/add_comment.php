<?php
    $mysqli = new mysqli("localhost", "f0522592_flow", "flow", "f0522592_flow");
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к БД";
    }

    $id = $_GET['id'];
    $text = $_GET['description'];

    $result = $mysqli->query("INSERT INTO comments SET text='$text', flow_id='$id'");
?>