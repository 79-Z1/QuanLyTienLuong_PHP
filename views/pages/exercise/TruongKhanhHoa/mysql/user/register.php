<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<style>
    form {
        width: 800px;
        margin: 50px auto;
    }
</style>

<body>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
    or die('Could not connect to MySQL: ' . mysqli_connect_error());
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
        <a class="mt-5" href="index.php">Quay lại</a>
    </form>
    <?php $this->end(); ?>