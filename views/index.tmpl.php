<? require_once COMPONENTS.'/header.php' ?>

<main class="main py-3">
    <div class="container-main">
        <div class="row">
            <? require_once COMPONENTS.'/sidebar.php' ?>
            <div class="col-10">
                <!-- основная часть страницы -->
                <h3><?= $header ?? '' ?></h3>

                <? foreach ($sidebar_posts as $post) : ?>
                    <div class="card mb-3 col-10">
                        <div class="card-body">
                            <h4 class="card-title"><a href="posts/show?id=<?= $post['posts_id'] ?>"><?= $post['title'] ?></a></h4>
                            <h5 class="card-text"><?= $post['descroption'] ?></h5>
                            <p class="card-text"><?= $post['content'] ?></p>
                            <p class="card-text"><small class="text-body-secondary">Last updated <?= $post['updated_at'] ?></small></p>
                            <a class="btn bg-dark-subtle" href="update?id=<?= $post['posts_id'] ?>" >Update</a>
                        </div>
                    </div>

                <? endforeach ?>
            </div>
        </div>
    </div>
</main>
<? require_once COMPONENTS.'/footer.php' ?>
</div>