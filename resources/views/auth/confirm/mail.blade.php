<html>
<head>
    <meta charset="UTF-8">
    <title>Активация регистрации нового пользователя</title>
</head>
<body>
<h2>Здравстсвуйте {{$user->name}}! Спасибо за регистрацию на сервисе "Admin-Quests"</h2>
<p>
    Для подтверждения адреса электронной почты перейдите <a href='{{ url("register/{$user->token}") }}'>по ссылке </a>, или нажмите на кнопку ниже.
</p>
<a href='{{ url("register/{$user->token}") }}'><button type="button" style="padding: 15px; color: white; font-size: 16px; font-weight: 500; background-color: rgba(190,23,19,0.83); border: 0; border-radius: 10px;">Подтвердить</button></a>
</body>
</html>