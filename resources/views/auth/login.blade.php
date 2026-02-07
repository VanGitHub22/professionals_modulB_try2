<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    @auth
        <a href="/logout">Выйти</a>
    @endauth
    <form action="/login" method="POST">
        @csrf
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="Войти">
        <a href="/register">Зарегистрироваться</a>
    </form>
</body>
</html>