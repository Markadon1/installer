<html>
<head>
    <meta charset="UTF-8">
    <title>Восстановления пароля от аккаунта {{$user->email}}</title>
</head>
<body>
<h2>Здравстсвуйте {{$user->name}}! Вы получили это письмо, потому что отправили заявку на восстановление пароля</h2>
<p>
    Для сброса пароля перейдите <a href='{{ url("reset/{$user->token}") }}'>по ссылке </a>, или нажмите на кнопку ниже.
</p>
<a href='{{ url("reset/{$user->token}") }}'><button type="button" style="padding: 15px; color: white; font-size: 16px; font-weight: 500; background-color: rgba(190,23,19,0.83); border: 0; border-radius: 10px;">Подтвердить</button></a>
</body>
</html>