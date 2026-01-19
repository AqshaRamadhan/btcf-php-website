<?php
include 'db.php';
$message = "";
$msgType = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    $role = 'user'; // Default role user

    if ($password !== $confirm) {
        $message = "Password konfirmasi tidak cocok!";
        $msgType = "danger";
    } else {
        // Cek duplikat Username/Email
        $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $check->bind_param("ss", $username, $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "Username atau Email sudah terdaftar!";
            $msgType = "warning";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hash, $role);
            
            if ($stmt->execute()) {
                echo "<script>alert('Berhasil! Silakan Login'); window.location='login.php';</script>";
            } else {
                $message = "Gagal mendaftar.";
                $msgType = "danger";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - BTCF</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --default-font: "Roboto", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
            --heading-font: "Raleway", sans-serif;
            --accent-color: #6BAA75;
            --heading-color: #273d4e;
            --default-color: #444444;
        }
        body { 
            font-family: var(--default-font);
            color: var(--default-color);
            background: #f1f4fa; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
        }
        .card { 
            width: 100%; 
            max-width: 450px; 
            border-radius: 10px;
            background: #ffffff;
        }
        h4 {
            font-family: var(--heading-font);
            color: var(--heading-color);
            font-weight: 700;
        }
        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
        .btn-primary:hover {
            background-color: #5a9a65;
            border-color: #5a9a65;
        }
        a {
            color: var(--accent-color);
        }
        a:hover {
            color: #5a9a65;
        }
    </style>
</head>
<body>
    <div class="card p-4 shadow-sm">
        <h4 class="text-center mb-3 fw-bold">Daftar Akun Baru</h4>
        <?php if ($message): ?>
            <div class="alert alert-<?= $msgType ?>"><?= $message ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Ulangi Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
        </form>
        <div class="text-center mt-3">
            <a href="login.php">Sudah punya akun? Login</a>
        </div>
    </div>
</body>
</html>