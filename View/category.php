<?php
require "../Controller/Controller.php";

$controller = new Controller();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$products = $controller->getDataCategory("categories",$limit,$offset);
$totalData = $controller->countDataCategory("categories");
$totalPages = ceil($totalData / $limit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kategori</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-3">Daftar Kategori</h2>
    <div class="mb-3">
        <a href="index.php" class="btn btn-primary mb-10">List Produk</a>
    </div>
    <a href="createCategory.php" class="btn btn-primary mb-10">Tambah Kategori</a>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Kategori Produk</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><a href="updateCategory.php?id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a></td>
                <td>
                    <button class="btn btn-danger btn-sm"
                            onclick="confirmDelete(<?= $product['id'] ?>)">
                        Delete
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li>
                    <a href="?page=<?= $page - 1 ?>">&laquo; Sebelumnya</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="<?= ($page == $i) ? 'active' : '' ?>">
                    <a href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li>
                    <a href="?page=<?= $page + 1 ?>">Berikutnya &raquo;</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>


</div>
</body>
</html>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `deleteCategory.php?id=${id}`;
            }
        });
    }
</script>

