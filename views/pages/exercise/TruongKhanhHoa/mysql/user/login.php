<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>

<style>
    form {
        width: 800px;
        margin: 50px auto;
    }
</style>
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
        $sql = "select * from user where username = '$username' and password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) <> 0) {
            header('Location: ' . '../Sua/2.7.php');
        } else {
            array_push($errs, 'Sai username hoặc mật khẩu');
        }
    } else array_push($errs, 'Không được để trống thông tin đăng nhập');
}
?>
<form method="post">
    <h1 align="center">LOGIN FORM</h1>
    <div class="form-outline mb-4">
        <input type="text" id="username" class="form-control" name="username" value="<?= $username ?>" />
        <label class="form-label" for="username">Username</label>
    </div>

    <div class="form-outline mb-4">
        <input type="password" id="password" class="form-control" name="password" value="<?= $password ?>" />
        <label class="form-label" for="password">Password</label>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
        <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                <label class="form-check-label" for="form2Example31"> Remember me </label>
            </div>
        </div>
    </div>
    <div>
        <?php foreach ($errs as $err) : ?>
            <p style="color: red; width: 100%;" align="center"><?= $err ?></p>
        <?php endforeach ?>
    </div>
    <!-- Submit button -->
    <button type="submit" name='submit' class="btn btn-primary btn-block mb-4">Sign in</button>
    <br>
    <a class="mt-5" href="index.php">Quay lại</a>
</form>
<?php $this->end(); ?>