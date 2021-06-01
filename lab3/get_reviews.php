<?php
    $mysqli = new mysqli("localhost", "f0522592_flow", "flow", "f0522592_flow");
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к БД";
    }

    $result = $mysqli->query(
        "SELECT name, email, message FROM reviews"
    );

    if ($result){
        while ($row = $result->fetch_array()){
            $name = $row['name'];
            $email = $row['email'];
            $review = $row['message'];

            echo "<h2>";
            echo sprintf("%s - %s",$name, $email);
            echo "</h2>";
            echo "<p style='font-size: 20px;'>";
            echo $review;
            echo "</p>";
        }
    }
?>