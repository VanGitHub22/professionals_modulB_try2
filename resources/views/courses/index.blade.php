<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Курсы</title>
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
                <a href="courses?page=<?=$_GET['page']-1?>">Назад</a>
            @endif
            @if($countPages > $_GET['page'])
                <a href="courses?page=<?=$_GET['page']+1?>">Дальше</a>
            @endif
        @else
            <a href="courses?page=2">Дальше</a>
        @endif
    @endif
    @foreach($courses as $course)
        <p>{{ $course->name }}</p>
        <p>{{ $course->description }}</p>
        <p>{{ $course->duration }}ч</p>
        <p>{{ $course->price }}р</p>
        <p>{{ $course->date_start }}</p>
        <p>{{ $course->date_end }}</p>
        <hr>
    @endforeach
</body>
</html>