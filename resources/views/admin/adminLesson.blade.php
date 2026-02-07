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
    <hr>
    <form action="/adminLesson" method="POST">
        @csrf
        <input type="text" name="name" placeholder="name">
        <input type="text" name="description" placeholder="description">
        <input type="text" name="link" placeholder="link">
        <input type="number" name="duration" placeholder="duration">
        <select name="course_id">
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
        <input type="submit" value="Добавить">
    </form>
    <hr>
    @foreach($lessons as $lesson)
        <form action="/adminLesson" method="POST">
            @csrf
            @METHOD("PATCH")
            <input type="hidden" name="id" value="{{ $lesson->id }}">
            <input type="text" name="name" value="{{ $lesson->name }}" placeholder="name">
            <input type="text" name="description" value="{{ $lesson->description }}" placeholder="description">
            <input type="text" name="link" value="{{ $lesson->link }}" placeholder="link">
            <input type="number" name="duration" value="{{ $lesson->duration }}" placeholder="duration">
            <select name="course_id">
                @foreach($courses as $course)
                    @if($course->id == $lesson->course_id)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endif
                @endforeach
                @foreach($courses as $course)
                    @if($course->id != $lesson->course_id)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endif
                @endforeach
            </select>
            <input type="submit" value="Изменить">
        </form>
        <form action="/adminLesson" method="POST">
            @csrf
            @METHOD("DELETE")
            <input type="hidden" name="id" value="{{ $lesson->id }}">
            <input type="submit" value="Удалить">
        </form>
        <hr>
    @endforeach
</body>
</html>