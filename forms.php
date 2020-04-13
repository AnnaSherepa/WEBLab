<!--файл демонструє роботу з http запитами на простому прикладі реалізації форм-->
<!DOCTYPE html>
<html>
<head>
    <title>Forms</title>
</head>

<body>
<!--action місце, де оброблятиметься форма
method - спосіб передачі даних-->
<form name="test" action="check.php" method="post">
    <label>Имя: </label><br>
    <!--name кожного input виступатиме ключем асоціативного масиву для передачі даних-->
    <input type="text" name="name" placeholder="Имя">
    <br>
    <label>Email: </label><br>
    <input type="text" name="email" placeholder="Email">
    <br>
    <label>Сообщения:</label><br>
    <textarea type="text" name="message" placeholder="Сообщения" cols="40" rows="5"></textarea>
    <br>
    <!-- type="submit" тому що необхідно перезавантажити сторінку-->
    <input type="submit" name="done" value="Отправить">
</form>
</body>
</html>