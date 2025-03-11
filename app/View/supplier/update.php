<?php require __DIR__ . '/../navbar.php'; ?>

<div class="container mt-4">
    <!-- Notifikasi -->
    <?php if (isset($model['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> <?= $model['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($model['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> <?= $model['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Form Update Supplier -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title text-center">Update Supplier</h4>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $model['supplier']->id ?>">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="<?= $model['supplier']->name ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="contact" name="contact"
                                   value="<?= $model['supplier']->contact ?>" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-pencil-square"></i> Update Supplier
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
