<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form action="{{ route('checkSignIn') }}" method="post">
        @csrf
        <div>
            <label for="">Username</label>
            <input type="text" name="username">
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <label for="">RePass</label>
            <input type="password" name="repass">
        </div>
        <div>
            <label for="">MSSV</label>
            <input type="text" name="mssv">
        </div>
        <div>
            <label for="">LopMonHoc</label>
            <input type="text" name="lopmonhoc">
        </div>
        <div>
            <label for="">GioiTinh</label>
            <input type="radio" name="gioitinh" value="Nam">Nam
            <input type="radio" name="gioitinh" value="Nu">Nu
        </div>
        <button type="submit">Register</button>
    </form>
</body>

</html>