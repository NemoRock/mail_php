<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="mailerPHP">
    <form enctype="multipart/form-data" method="post" id="form" onsubmit="send(event, 'send.php')">
        <p>Имя</p>
        <input placeholder="Представьтесь" name="name" type="text">
        <p>Email</p>
        <input placeholder="Укажите почту" name="email" type="text">
        <p>Сообщение</p>
        <textarea name="text"></textarea>
        <p>Прикрепить файлы</p>
        <input type="file" name="myfile[]" multiple id="myfile">
        <p><input value="Отправить" type="submit"></p>
    </form>
</div>
</body>
<script>
    // Отправка данных на сервер
    function send(event, php) {
        console.log("Отправка запроса");
        event.preventDefault ? event.preventDefault() : event.returnValue = false;
        var req = new XMLHttpRequest();
        req.open('POST', php, true);
        req.onload = function () {
            if (req.status >= 200 && req.status < 400) {
                json = JSON.parse(this.response); // Ебанный internet explorer 11
                console.log(json);

                // ЗДЕСЬ УКАЗЫВАЕМ ДЕЙСТВИЯ В СЛУЧАЕ УСПЕХА ИЛИ НЕУДАЧИ
                if (json.result == "success") {
                    // Если сообщение отправлено
                    alert("Сообщение отправлено");
                } else {
                    // Если произошла ошибка
                    alert("Ошибка. Сообщение не отправлено");
                }
                // Если не удалось связаться с php файлом
            } else {
                alert("Ошибка сервера. Номер: " + req.status);
            }
        };

// Если не удалось отправить запрос. Стоит блок на хостинге
        req.onerror = function () {
            alert("Ошибка отправки запроса");
        };
        req.send(new FormData(event.target));
    }
</script>
</html>