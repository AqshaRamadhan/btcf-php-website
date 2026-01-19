<?php
session_start();
include 'db.php';

// Cek Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit;
}

$id = $_GET['id'];
$message = "";

// Ambil data produk saat ini
$stmt = $conn->prepare("SELECT * FROM products WHERE productid = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "Produk tidak ditemukan!";
    exit;
}

// --- LOGIKA UPDATE ---
if (isset($_POST['update'])) {
    $name = $_POST['prod_name'];
    $desc = $_POST['prod_desc'];
    $link = $_POST['prod_link'];
    
    // Cek apakah user mengupload gambar baru
    if (!empty($_FILES["prod_img"]["name"])) {
        $target_dir = "assets/img/";
        $file_name = basename($_FILES["prod_img"]["name"]);
        $target_file = $target_dir . time() . "_" . $file_name;
        $db_file_name = time() . "_" . $file_name;

        // Upload gambar baru
        if (move_uploaded_file($_FILES["prod_img"]["tmp_name"], $target_file)) {
            // Hapus gambar lama agar hemat storage
            $old_img = "assets/img/" . $data['prod_img'];
            if (file_exists($old_img)) { unlink($old_img); }

            // Update database dengan gambar baru
            $stmt_up = $conn->prepare("UPDATE products SET prod_name=?, prod_desc=?, prod_link=?, prod_img=? WHERE productid=?");
            $stmt_up->bind_param("ssssi", $name, $desc, $link, $db_file_name, $id);
        }
    } else {
        // Jika tidak upload gambar, update data teks saja
        $stmt_up = $conn->prepare("UPDATE products SET prod_name=?, prod_desc=?, prod_link=? WHERE productid=?");
        $stmt_up->bind_param("sssi", $name, $desc, $link, $id);
    }

    if (isset($stmt_up) && $stmt_up->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='admin.php';</script>";
    } else {
        $message = "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - BTCF</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header { background-color: #6BAA75 !important; }
        .btn-success { background-color: #6BAA75; border-color: #6BAA75; }
    </style>
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-white fw-bold">Edit Produk</div>
                    <div class="card-body">
                        <?php if ($message): ?>
                            <div class="alert alert-danger"><?= $message ?></div>
                        <?php endif; ?>

                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="prod_name" class="form-control" value="<?= htmlspecialchars($data['prod_name']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Link Pendaftaran</label>
                                <input type="url" name="prod_link" class="form-control" value="<?= htmlspecialchars($data['prod_link']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="prod_desc" class="form-control" rows="4" required><?= htmlspecialchars($data['prod_desc']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar Saat Ini</label><br>
                                <img src="assets/img/<?= htmlspecialchars($data['prod_img']) ?>" width="100" class="rounded mb-2">
                                <input type="file" name="prod_img" class="form-control text-sm">
                                <small class="text-muted">*Biarkan kosong jika tidak ingin mengganti gambar</small>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="admin.php" class="btn btn-secondary">Batal</a>
                                <button type="submit" name="update" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>