<? require_once COMPONENTS . '/header.php' ?>

<main class="main py-3">
    <div class="container-main">
        <div class="row">
            <div class="col-10">
                <!-- основная часть страницы -->
                <h3><?= $header ?? '' ?></h3>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Input title</label>
                        <input type="title" class="form-control" id="title" name="title" value=<?=old('title')  ?>>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">description</label>
                        <input type="description" class="form-control" id="description" name="description" value=<?=old('description')  ?>>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="3" name="content"><?=old('content')  ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">create</button>
                </form>
            </div>
        </div>
    </div>
</main>
<? require_once COMPONENTS . '/footer.php' ?>
</div>