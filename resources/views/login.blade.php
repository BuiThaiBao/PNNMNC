<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="{{ route('checkLogin') }}" method="post">
        @csrf
        <div>
            <label for="">Username</label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="">MSSV</label>
            <input type="text" name="mssv">
        </div>
        <button type="submit">Login</button>
    </form>
</body>

</html>