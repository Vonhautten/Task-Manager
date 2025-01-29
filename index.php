<?php
// Memulai sesi
session_start();

if (isset($_SESSION['id_user']) && isset($_SESSION['username'])) {
    header("Location: login/index.php?page=dashboard"); 
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="login/css/styles_login.css?v=1.0">
    </head>
    <body>
        <div class="login-container">
            <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == 'gagal') {
                        echo "<div class='error-message'>" . "Gagal Login, username atau password salah" . "</div>";
                    } elseif ($_GET['pesan'] == 'logout') {
                        echo "<div class='logout-message'>" . "Anda sudah logout" . "</div>";
                    } elseif ($_GET['pesan'] == 'berhasil') {
                        echo "<div class='success-message'>Sign Up berhasil! Silahkan login.</div>";
                    }
                }
            ?>
            <form class="login-form" action="login.php" method="post">
                <h2>Login Task Manager</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="pengguna" placeholder="Masukan username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="pw">
                        <input type="password" id="password" name="katakunci" placeholder="Masukan password" required>

                        <div class="checkbox-wrapper">
                            <input type="checkbox" class="check" id="showPasswordCheckbox">
                            <label for="showPasswordCheckbox" class="label">
                                <svg width="45" height="45" viewBox="0 0 95 95">
                                    <rect x="30" y="20" width="50" height="50" stroke="black" fill="none"></rect>
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4" stroke="black" stroke-width="3" fill="none" class="path1"></path>
                                    </g>
                                </svg>
                            </label>
                        </div>
                    </div>
                </div>
                <script>
                    document.getElementById('showPasswordCheckbox').addEventListener('change', function () {
                        const passwordField = document.getElementById('password');
                        passwordField.type = this.checked ? 'text' : 'password';
                    });
                </script>
                <button type="submit" name="tombollogin" value="Log In">Login</button>
                <p>Belum punya akun? <a href="signup.php" class="login-link">Sign-Up</a></p>
            </form>
        </div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </body>
</html>
