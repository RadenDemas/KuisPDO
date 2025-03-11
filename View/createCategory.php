<?php
require  "../Controller/Controller.php";

$controller = new Controller();

if(isset($_POST["submit"])){
    $data = [
        'name'=>$_POST["nama_kategori"]
    ];
    if ($controller->insertCategory("categories", $data)) {
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data telah berhasil ditambahkan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'category.php';
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
        <h3 class="mb-3">Tambah Kategori Baru</h3>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Tambah Kategori</button>
        </form>
    </div>
</div>
</body>
</html>