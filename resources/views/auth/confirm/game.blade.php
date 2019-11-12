<html>
<head>
    <meta charset="UTF-8">
    <title>Активация регистрации нового пользователя</title>
</head>
<body>
<h2>Здравстсвуйте {{$user->name}}! Вам пришла новая бронь в системе quest-crm.com</h2>
<p style="color: #333;">
Для более подробной информации, перейдите на сайт.
    <br>
    <br>
    <a href='{{ url("/") }}'><button type="button" style="padding: 15px; color: white; font-size: 16px; font-weight: 500; background-color: rgba(25,255,42,0.84); border: 0; border-radius: 10px; width: 200px;">Перейти</button></a>
    <br>
</p>
</body>
</html>
