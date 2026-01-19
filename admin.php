<?php
session_start();
include 'db.php';

// Cek Proteksi Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$message = "";

// --- LOGIKA HAPUS (DELETE) ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // 1. Ambil nama gambar dulu agar bisa dihapus dari folder
    $stmt = $conn->prepare("SELECT prod_img FROM products WHERE productid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row) {
        // Hapus file gambar dari folder assets/img/
        $file_path = "assets/img/" . $row['prod_img'];
        if (file_exists($file_path)) {
            unlink($file_path); 
        }

        // 2. Hapus data dari database
        $stmt_del = $conn->prepare("DELETE FROM products WHERE productid = ?");
        $stmt_del->bind_param("i", $id);
        if ($stmt_del->execute()) {
            echo "<script>alert('Produk berhasil dihapus!'); window.location='admin.php';</script>";
        } else {
            $message = "Gagal menghapus data.";
        }
    }
}

// --- LOGIKA TAMBAH (CREATE) ---
if (isset($_POST['submit'])) {
    $name = $_POST['prod_name'];
    $desc = $_POST['prod_desc'];
    $link = $_POST['prod_link'];
    
    $target_dir = "assets/img/";
    $file_name = basename($_FILES["prod_img"]["name"]);
    // Tambahkan timestamp agar nama file unik
    $target_file = $target_dir . time() . "_" . $file_name;
    $db_file_name = time() . "_" . $file_name;
    
    $check = getimagesize($_FILES["prod_img"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["prod_img"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO products (prod_name, prod_desc, prod_link, prod_img) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $desc, $link, $db_file_name);
            
            if ($stmt->execute()) {
                $message = "Produk berhasil ditambahkan!";
            } else {
                $message = "Database Error: " . $conn->error;
            }
        } else {
            $message = "Gagal upload gambar.";
        }
    } else {
        $message = "File bukan gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BTCF</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
        body { font-family: var(--default-font); color: var(--default-color); background: #f1f4fa; }
        h2, h4 { font-family: var(--heading-font); color: var(--heading-color); font-weight: 700; }
        .card-header { background-color: var(--accent-color) !important; border-color: var(--accent-color); }
        .btn-primary, .btn-success { background-color: var(--accent-color); border-color: var(--accent-color); }
        .btn-primary:hover, .btn-success:hover { background-color: #5a9a65; border-color: #5a9a65; }
        .btn-outline-primary { color: var(--accent-color); border-color: var(--accent-color); }
        .btn-outline-primary:hover { background-color: var(--accent-color); border-color: var(--accent-color); }
        .table img { width: 60px; height: 60px; object-fit: cover; border-radius: 5px; }
    </style>
</head>
<body class="p-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Admin Dashboard</h2>
            <div>
                <a href="index.php" class="btn btn-outline-primary">Lihat Web</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header text-white fw-bold">Tambah Produk Baru</div>
                    <div class="card-body">
                        <?php if ($message): ?>
                            <div class="alert alert-info py-2 small"><?= $message ?></div>
                        <?php endif; ?>
                        
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-2">
                                <label class="form-label small">Nama Produk</label>
                                <input type="text" name="prod_name" class="form-control form-control-sm" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">Link Pendaftaran</label>
                                <input type="url" name="prod_link" class="form-control form-control-sm" placeholder="https://..." required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small">Deskripsi</label>
                                <textarea name="prod_desc" class="form-control form-control-sm" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small">Gambar</label>
                                <input type="file" name="prod_img" class="form-control form-control-sm" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success w-100 btn-sm">Upload Produk</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header text-white fw-bold">Daftar Produk Saat Ini</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Info Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Ambil data dari database
                                    $q = "SELECT * FROM products ORDER BY created_at DESC";
                                    $res = $conn->query($q);
                                    $no = 1;
                                    
                                    if ($res->num_rows > 0) {
                                        while($row = $res->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <img src="assets/img/<?= htmlspecialchars($row['prod_img']) ?>" alt="img">
                                        </td>
                                        <td>
                                            <strong><?= htmlspecialchars($row['prod_name']) ?></strong><br>
                                            <small class="text-muted">
                                                Link: <a href="<?= htmlspecialchars($row['prod_link']) ?>" target="_blank">Buka Link</a>
                                            </small>
                                            <p class="small text-secondary mb-0 text-truncate" style="max-width: 250px;">
                                                <?= htmlspecialchars($row['prod_desc']) ?>
                                            </p>
                                        </td>
                                        <td>
                                            <a href="edit.php?id=<?= $row['productid'] ?>" class="btn btn-warning btn-sm text-white mb-1">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="admin.php?delete=<?= $row['productid'] ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                        } 
                                    } else {
                                        echo "<tr><td colspan='4' class='text-center'>Belum ada data produk.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>