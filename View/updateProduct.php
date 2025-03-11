<?php
require_once "../Controller/Controller.php";

$controller = new Controller();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = $controller->getDataById("products", $id);
} else {
    echo "ID tidak ditemukan!";
    exit;
}

// Proses Update
if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $updateData = [
        'name' => $nama_produk,
        'price' => $harga,
        'stock' => $stok,
    ];
    if ($controller->updateData("products", $updateData, $id)) {
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data telah berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php';
                    }
                });
            };
        </script>";
    } else {
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menambahkan data',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                });
            };
        </script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">
    <div class="card p-4 mb-4">
        <h3 class="mb-3">Tambah Produk Baru</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($product['price']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?= htmlspecialchars($product['stock'])?>"  required>
            </div>
            <!--        <div class="mb-3">-->
            <!--            <label for="kategori" class="form-label">Kategori</label>-->
            <!--            <input type="text" class="form-control" id="kategori" name="kategori" required>-->
            <!--        </div>-->
            <button type="submit" class="btn btn-primary" name="submit">Tambah Produk</button>
        </form>
    </div>
</div>
</body>
</html>