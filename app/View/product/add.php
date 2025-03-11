<div class="justify-content-center">

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
        <div class="col-md-6">
            <form method="post" action="/add">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="name">
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="Description" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="Due_date" class="form-label">Due date</label>
                    <input type="date" class="form-control" id="Due_date" name="due_date">
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>