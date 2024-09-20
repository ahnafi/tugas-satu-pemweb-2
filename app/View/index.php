<?php
$tasks = $model['tasks'];
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
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tasks)): ?>
                    <tr>
                        <td colspan="4" class="text-center">No task found</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td scope="row"><?= $task['title'] ?></td>
                        <td><?= $task['description'] ?></td>
                        <td><?= $task['due_date'] ?></td>
                        <td class="d-flex">
                            <a href="/update/<?= $task['id'] ?>" class="btn btn-warning">Update</a>
                            <form method="post" onsubmit="return warn()">
                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
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