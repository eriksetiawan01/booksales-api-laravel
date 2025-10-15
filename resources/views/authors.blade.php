<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Author</title>
</head>
<body>
    <h1>Ini halaman Author Buku</h1>
    @foreach ($authors as $author)
        <ul>
            <li><strong>Name :</strong> {{ $author['name']}}</li>
            <li><strong>Biography :</strong> {{ $author['bio']}}</li>
        </ul>
    @endforeach
</body>
</html>