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
    <form action="/register" method="POST">
        @csrf
        <input type="email" name="email" placeholder="email">
        <input type="text" name="name" placeholder="name">
        <input type="date" name="date" placeholder="date">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="Зарегистрироваться">
        <a href="/login">Войти</a>
    </form>
</body>
</html>