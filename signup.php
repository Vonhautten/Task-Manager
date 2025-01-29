<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login/css/styles_login.css?v=4.0">
</head>
    <body>
        <div class="login-container">
            <?php
            // Tampilkan pesan berdasarkan query string
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == 'kosong') {
                    echo "<div class='error-message'>Username atau password tidak boleh kosong.</div>";
                } else if ($_GET['pesan'] == 'password_tidak_sesuai') {
                    echo "<div class='error-message'>Password dan konfirmasi password tidak sesuai.</div>";
                } else if ($_GET['pesan'] == 'username_terdaftar') {
                    echo "<div class='error-message'>Username sudah terdaftar. Gunakan username lain.</div>";
                } else if ($_GET['pesan'] == 'gagal') {
                    echo "<div class='error-message'>Registrasi gagal, coba lagi.</div>";
                } else if ($_GET['pesan'] == 'berhasil') {
                    echo "<div class='success-message'>Registrasi berhasil! Silakan login.</div>";
                }
            }
            ?>
            <form class="login-form" action="signup_action.php" method="post">
                <h2>Sign Up Task Manager</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username">
                </div>
                <div class="form-group">
                <label for="password">Password</label>
                <div class="pw">
                    <input type="password" id="password" name="password" placeholder="Masukkan password">
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
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <div class="pw">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Masukkan ulang password">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" class="check" id="showConfirmPasswordCheckbox">
                        <label for="showConfirmPasswordCheckbox" class="label">
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
                    if (this.checked) {
                        passwordField.type = 'text'; 
                    } else {
                        passwordField.type = 'password';
                    }
                });
                document.getElementById('showConfirmPasswordCheckbox').addEventListener('change', function () {
                    const confirmPasswordField = document.getElementById('confirm_password');
                    if (this.checked) {
                        confirmPasswordField.type = 'text'; 
                    } else {
                        confirmPasswordField.type = 'password';
                    }
                });
            </script>
                <button type="submit" name="signup_button" value="Sign Up">Sign Up</button>
                <p>Sudah punya akun? <a href="index.php" class="login-link">Login</a></p>
            </form>
        </div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </body>
</html>