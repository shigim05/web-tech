<html>
    <head>
	<title>Мирзаева Ш.А.</title>
        <meta charset = "UTF-8">
        <style>
            .ui-slider {
                height: 15px;
                width: 200px;
            }
            .wrapper {
                float: center;
            	margin: 0 auto;
            }
        </style>
        <link rel="stylesheet" href="jquery-ui-1.12.1/jquery-ui.css">
        <script src="jquery-ui-1.12.1/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.12.1/jquery-ui.js"></script>
		<script>
		    $( function() {
			    $( document ).tooltip();
			    $("#birth_date").datepicker({
                    dateFormat: "dd.mm.yy",
                    altFormat: "yy-mm-dd",
                    altField: "#altFormatDate",
                    changeMonth: true,
                    changeYear: true,
                    monthNames: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь",	"Октябрь", "Ноябрь", "Декабрь"],
                    monthNamesShort:["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
                    dayNames: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
                    dayNamesMin : ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                });

                $("#education").selectmenu();
                
                $("#ok_dialog").dialog({
                    autoOpen: false,
                    modal: true,
                    buttons: {
                        "Вернуться к вакансиям": function() {
                            window.location.href = 'index.html';
                            $(this).dialog("close");
                        },
                        "Хорошо": function() {
                            $(this).dialog("close");
                        }
                    }
                });
                $("#error_dialog").dialog({
                    autoOpen: false,
                });
		    });
	    </script>
	</head>
	<body align="center" style="background-image: url(bokeh.webp)">
        <?php
	        $header = $_GET['header'];
	        echo "<h1>$header</h1>";
	    ?>
	    
	    <form name="job_form" align="center">
            <p><div>Имя</div><input id = "first_name" title="Имя" type="text"></p>
            <p><div>Фамилия</div><input id = "second_name" title="Фамилия" type="text"></p>
            <p><div>Отчество</div><input id = "third_name" title="Отчество" type="text"></p>
            <p>
                <div>День Рождения</div>
                <input id = "birth_date" title="День рождения" type="text" >
                <input id = "altFormatDate" type="hidden" >
            </p>
            <p>
                <div>Образование</div>
                <select name="type" id="education">
                    <option value = "0">Без образования</option>
                    <option value = "1" selected="selected">Среднее</option>
                    <option value = "2">Высшее</option>
                </select>
            </p>
            <p>
                <div>О себе</div>
                <textarea id='yourself' cols='30' rows='10'></textarea>
            </p>
            <p>
                <div>Количество рабочих дней в месяц</div>
                <p><p class="wrapper" type="text" id="slider" readonly="readonly"></p>
                
            </p>
            
            <input id = "days_view" type="text" title="Количество рабочих дней" value="1" readonly="readonly">

            <p><div>Жалаемая заработная плата в день</div>
            <input id = "day_salary" title="Жалаемая заработная плата в день" onchange="count_salary();" type="text"></p>
            
            <p>
                <div>Заработная плата</div>
                <input id = "salary" type="text" title="Заработная плата" readonly="readonly">
            </p>
            
            <p><input class="ui-button ui-widget ui-corner-all" type="button" value="Подать заявку" onclick="send_form();"></p>
        </form>
        
        <div id="ok_dialog" title="Успех!">
            <p>Заявка подана успешно.</p>
        </div>
        <div id="error_dialog" title="Ошибка!">
            <p>Не все поля заполнены.</p>
        </div>
	</body>
	
	<script>
	    var work_days = 1;
        $("#slider").slider({
            step: 1,
            min: 1,
            max: 20,
            slide: function(event, ui) {
                document.job_form.days_view.value = ui.value;
                work_days = ui.value
                count_salary();
            }
        });
        
	
	    function send_form(){
	        var first_name = document.getElementById("first_name").value;
            var second_name = document.getElementById("second_name").value;
            var third_name = document.getElementById("third_name").value;
            var birth_date = document.getElementById("birth_date").value;
            var yourself = document.getElementById("yourself").value;
            var day_salary = document.getElementById("day_salary").value;

            if (length(first_name)==0  ||
                length(second_name)==0 ||
                length(third_name)==0  ||
                length(birth_date)==0  ||
                length(yourself)==0    ||
                length(day_salary)==0
            ){
                $("#error_dialog").dialog("open");
                return;
            }

            var education = document.getElementById("education").value;

            var work_days = document.getElementById("days_view").value;

            
            $("#ok_dialog").dialog("open");
	    }
	    
	    function count_salary(){
	        var salary = document.getElementById("salary");
	        
	        var day_salary = document.getElementById("day_salary").value;
	        
	        if (length(day_salary)==0){
	            return;
	        }
	        
	        salary.value = work_days * day_salary;
	    }
	    
	   function length(str){
            var strIter = str[Symbol.iterator]();
            let str_lenght = 0;
            for (let ch of strIter){str_lenght++;}
            return str_lenght;
        }
	</script>
</html>