<? require_once COMPONENTS . '/header.php' ?>

<main class="main py-3">
    <div class="container-main">
        <div class="row">
            <? require_once COMPONENTS . '/sidebar.php' ?>

            <div class="col-10">
                <!-- основная часть страницы -->
                <h3><?= $header ?? '' ?></h3>
                <p><?= $posts['content'] ?></p>
            </div>
        </div>
    </div>
</main>
<? require_once COMPONENTS . '/footer.php' ?>
</div>