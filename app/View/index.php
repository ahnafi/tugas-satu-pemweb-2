<?php 
    $tasks = $model['tasks'];
?>

<div class="container">
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>