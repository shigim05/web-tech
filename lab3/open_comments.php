<html>
    <title>Комментарии</title>
    <body>
        <?php
            $mysqli = new mysqli("localhost", "f0522592_flow", "flow", "f0522592_flow");
            if ($mysqli->connect_errno) {
                echo "Не удалось подключиться к БД";
            }

            $id = $_GET['id'];

            $result = $mysqli->query("SELECT id_f, name, spec, pic FROM flow WHERE id_f = '$id'");

            if ($result){
                while ($row = $result->fetch_array()){
                    $header = $row['name'];
                    $text = $row['spec'];
                    $image = $row['pic'];

                    echo "<p>";
                    echo "<table style='background-color:cyan'>";
                    echo "<tr><th style='font-size:30px' colspan='1'>$header</th></tr>";
                    echo "<tr>";
                    echo "<td>";
                    echo "<img width='250px' height='250px' src='$image'>";
                    echo "</td>";
                    echo "<td>";
                    echo $text;
                    echo "</td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</p>";
                }
            }
            else{
                echo "Не удалось загрузить";
            }

            echo "<h1>Комментарии</h1>";
            echo "<section id='comments_$id'>";

            $result = $mysqli->query("SELECT text FROM comments WHERE flow_id = '$id'");

            if ($result){
                while ($row = $result->fetch_array()){
                    $text = $row['text'];

                    echo "<p>";
                    echo " - $text";
                    echo "</p>";
                }
            }

            echo "</section>";

            echo "<p>";

            echo "<input id='new_comment_$id' type='text'><input type='button' value='Добавить комментарии' onclick='add_comment($id)'>";

            echo "</p>";
        ?>

        <script language="JavaScript" src="jquery.js"></script>
        <script language="JavaScript">
            function add_comment(news_id){
                // Поле с комментарием
                var comment_input = document.getElementById("new_comment_"+news_id);
                // Текст комментария
                var comment = comment_input.value;
                // Очистка поля
                comment_input.value = "";

                // Запрос
                $.ajax({
                    type: "GET",
                    url: "add_comment.php?id="+news_id+"&description="+comment,
                    dataType: "html",
                    success: function(data){
                        var comment_section_id = "comments_"+news_id;
                        var comment_section = document.getElementById(comment_section_id);
                        comment_section.innerHTML += "<p> - " + comment + "</p>";
                    }
                });
            }
        </script>
    </body>
</html>