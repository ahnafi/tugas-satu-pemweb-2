<?php
$tasks = $model['tasks'];
?>

<div class="container">

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

    <div class="row py-3">
        <div class="col-md-12 text-center">
            <h1>ToDo LIST app</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="/add" class="btn btn-primary my-2">Add new task</a>
        </div>
    </div>
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
                            <td colspan="3" class="text-center">No task found</td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td scope="row"><?= $task['title'] ?></td>
                            <td><?= $task['description'] ?></td>
                            <td><?= $task['due_date'] ?></td>
                            <td>
                                <a href="/update/<?= $task['id'] ?>" class="btn btn-warning">Update</a>
                                <a href="/delete/<?= $task['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>