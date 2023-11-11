<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
        form {
            width: 800px;
            margin: 50px auto;
        }
    </style>
</head>

<body>
    <?php
    require("../connect.php");
    if (isset($_POST['username'])) $username = $_POST['username'];
    else $username = '';
    if (isset($_POST['password'])) $password = $_POST['password'];
    else $password = '';
    $errs = [];

    if (isset($_POST['submit'])) {
        if (isset($_POST['username'], $_POST['password'])) {
            $checkusername = "select * from user where username = '$username'";
            $isduplicate = mysqli_query($conn, $checkusername);
            if (mysqli_num_rows($isduplicate) <> 0) {
                array_push($errs, 'Username đã tồn tại!!!');
            } else {
                $sql = "INSERT INTO `user` (`username`, `password`) VALUES ('$username', '$password')";
                $result = mysqli_query($conn, $sql);
                header('Location: ' . 'login.php');
            }
        } else array_push($errs, 'Không được để trống thông tin đăng kí');
    }
    ?>
    <form method="post">
        <h1 align="center">REGISTER FORM</h1>
        <div class="form-outline mb-4">
            <input type="text" id="username" class="form-control" name="username" value="<?= $username ?>" />
            <label class="form-label" for="username">Username</label>
        </div>

        <div class="form-outline mb-4">
            <input type="password" id="password" class="form-control" name="password" value="<?= $password ?>" />
            <label class="form-label" for="password">Password</label>
        </div>
        <div>
            <?php foreach ($errs as $err) : ?>
                <p style="color: red; width: 100%;" align="center"><?= $err ?></p>
            <?php endforeach ?>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" name='submit' class="btn btn-primary btn-block mb-4">Register</button>
        </div>
    </form>
</body>

</html>