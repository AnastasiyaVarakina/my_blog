<? require_once COMPONENTS . '/header.php' ?>

<main class="main py-3">
    <div class="container-main">
        <div class="row">
            <? require_once COMPONENTS . '/sidebar.php' ?>

            <div class="col-10">
                <!-- основная часть страницы -->
                <h3><?= $header ?? '' ?></h3>
                <p><?= $posts['content'] ?></p>
                <form action="posts" method="post">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="id" value="<?= $post['post_id'] ?>">
                    <button type="submit" class="btn btn-link">Delete</button>
                </form>
            </div>
        </div>
    </div>
</main>
<? require_once COMPONENTS . '/footer.php' ?>
</div>