<?php
$product = $model['product'];
?>


<?php if (isset($model['error'])) { ?>
    <div class="row">
        <div class="alert alert-danger my-3" role="alert">
            <?= $model['error'] ?>
        </div>
    </div>
<?php } ?>
<?php if (isset($model['success'])) { ?>
    <div class="row">
        <div class="alert alert-success my-3" role="alert">
            <?= $model['success'] ?>
        </div>
    </div>
<?php } ?>


<div class="row">
    <div class="col-md-12">
        <table class="table table-info">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Product name</th>
                <th scope="col">Supplier name</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($product)): ?>
                <tr>
                    <td colspan="4" class="text-center">No Product found</td>
                </tr>
            <?php endif; ?>
            <?php foreach ($product as $data): ?>
                <tr>
                    <td scope="row"><?= $data['id'] ?></td>
                    <td><?= $data['name'] ?></td>
                    <td><?= $data['supplier_name'] ?></td>
                    <td class="d-flex">
                        <a href="/update/<?= $data['id'] ?>" class="btn btn-warning">Update</a>
                        <form method="post" onsubmit="return warn()">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    function warn() {
        return confirm("Are you sure you want to delete this task?");
    }
</script>