<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель курсов</title>
</head>
<body>
    @auth
        <a href="/logout">Выйти</a>
    @endauth
    @if(count($allCourses) > 5)
        @php
            $countPages = ceil(count($allCourses)/5)
        @endphp
        @if(isset($_GET['page']))
            @if($_GET['page'] > 1)
                <a href="admin?page=<?=$_GET['page']-1?>">Назад</a>
            @endif
            @if($countPages > $_GET['page'])
                <a href="admin?page=<?=$_GET['page']+1?>">Дальше</a>
            @endif
        @else
            <a href="admin?page=2">Дальше</a>
        @endif
    @endif
    <hr>
    <form action="/admin" method="POST">
        @csrf
        <input type="text" name="name" placeholder="name">
        <input type="text" name="description" placeholder="description">
        <input type="number" name="duration" placeholder="duration">
        <input type="number" name="price" placeholder="price">
        <input type="date" name="date_start" placeholder="date_start">
        <input type="date" name="date_end" placeholder="date_end">
        <input type="submit" value="Добавить">
    </form>
    <hr>
    @foreach($courses as $course)
        <form action="/admin" method="POST">
            @csrf
            @METHOD("PATCH")
            <input type="hidden" name="id" value="{{ $course->id }}">
            <input type="text" name="name" value="{{ $course->name }}" placeholder="name">
            <input type="text" name="description" value="{{ $course->description }}" placeholder="description">
            <input type="number" name="duration" value="{{ $course->duration }}" placeholder="duration">
            <input type="number" name="price" value="{{ $course->price }}" placeholder="price">
            <input type="date" name="date_start" value="{{ $course->date_start }}" placeholder="date_start">
            <input type="date" name="date_end" value="{{ $course->date_end }}" placeholder="date_end">
            <input type="submit" value="Изменить">
        </form>
        <form action="/admin" method="POST">
            @csrf
            @METHOD("DELETE")
            <input type="hidden" name="id" value="{{ $course->id }}">
            <input type="submit" value="Удалить">
        </form>
        <hr>
    @endforeach
</body>
</html>