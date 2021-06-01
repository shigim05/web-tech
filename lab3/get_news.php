<?php
    $mysqli = new mysqli("localhost", "f0522592_flow", "flow", "f0522592_flow");
    if ($mysqli->connect_errno) {
        echo "Не удалось подключиться к БД";
    }

    $loaded = $_GET['loaded'];
    $need_to_load = $_GET['need_to_load'];

    $result = $mysqli->query(
        "SELECT  id_f, name, spec, pic FROM flow ORDER BY id_f DESC LIMIT $loaded, $need_to_load"
    );

    if ($result){
        while ($row = $result->fetch_array()){
            $id = $row['id_f'];
            $header = $row['name'];
            $text = $row['spec'];
            $image = $row['pic'];

            echo "<p>";
            echo "<table style='background-color:cyan'>";
            echo "<tr><th style='font-size:30px' colspan='1'>$header</th></tr>";
            echo "<tr>";
            echo "<td>";
            echo "<img width='250px' height='250px' src='$image' onclick=\"window.location.href='open_comments.php?id=$id'\">";
            echo "</td>";
            echo "<td>";
            echo $text;
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            echo "</p>";
        }
    }
?>