<?php
$supplier = $model['supplier'];
require __DIR__ . '/../navbar.php';
?>

<div class="container mt-4">
    <!-- Notifikasi -->
    <?php if (isset($model['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= $model['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php if (isset($model['success'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> <?= $model['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <!-- Card Tabel Supplier -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Supplier List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Supplier Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($supplier)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No Supplier found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($supplier as $data): ?>
                            <tr>
                                <td><?= $data->id ?></td>
                                <td><?= $data->name ?></td>
                                <td><?= $data->contact ?></td>
                                <td class="text-center">
                                    <a href="/update/<?= $data->id ?>" class="btn btn-warning btn-sm mx-1">
                                        <i class="bi bi-pencil-square"></i> Update
                                    </a>
                                    <form method="post" onsubmit="return warn()" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $data->id ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Konfirmasi Delete -->
<script>
    function warn() {
        return confirm("Are you sure you want to delete this supplier?");
    }
</script>

<!-- Tambahkan Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
