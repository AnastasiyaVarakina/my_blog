<? require_once COMPONENTS . '/header.php' ?>

<main class="main py-3">
    <div class="container-main">
        <div class="row">
            <div class="col-10">
                <!-- основная часть страницы -->
                <h3><?= $header ?? '' ?></h3>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Post title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>">
                        <?= isset($validator) ? $validator->listErrors("title") : ''?>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">description</label>
                        <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($post['descroption']) ?>">
                        <?= isset($validator) ? $validator->listErrors("description") : ''?>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="3" name="content"><?= htmlspecialchars($post['content']) ?></textarea>
                        <?= isset($validator) ? $validator->listErrors("content") : ''?>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</main>
<? require_once COMPONENTS . '/footer.php' ?>