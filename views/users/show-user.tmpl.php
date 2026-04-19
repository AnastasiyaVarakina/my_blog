<? require_once COMPONENTS . '/header.php' ?>

<main class="main py-3">
    <div class="container-main">
        <div class="row">
            <div class="col-10">
                <!-- основная часть страницы -->
                <h3><?= $header ?? '' ?></h3>

                <? foreach ($users as $user) : ?>
                    <div class="card mb-3 col-10">
                        <div class="card-body">
                            <h4 class="card-title"><?= $user['name'] ?></h4>
                            <p class="card-text"><?= $user['email'] ?></p>
                            <p class="card-text"><?= $user['created_at'] ?></p>
                            <a class="btn bg-dark-subtle" href="updateuser?id=<?= $user['users_id'] ?>" >Update</a>
                        </div>
                    </div>
                <? endforeach ?>
            </div>
        </div>
    </div>
</main>
<? require_once COMPONENTS . '/footer.php' ?>
</div>