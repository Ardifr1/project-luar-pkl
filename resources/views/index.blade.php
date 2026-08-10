<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Daftar Guru</h1>

@foreach ($guru as $item)
    <p>{{ $item->name }}</p>
    <p>{{ $item->username }}</p>
    <p>{{ $item->role }}</p>
    <hr>
@endforeach
</body>
</html>