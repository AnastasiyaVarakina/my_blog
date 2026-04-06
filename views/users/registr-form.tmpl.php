<? require_once COMPONENTS . '/header.php' ?>

<main class="main py-3">
    <div class="container-main">
        <div class="row">
            <div class="col-10">
                <!-- основная часть страницы -->
                <h3><?= $header ?? '' ?></h3>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <?= isset($validator) ? $validator->listErrors("name") : ''?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <?= isset($validator) ? $validator->listErrors("email") : ''?>
                    </div>    
                    <div class="mb-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <?= isset($validator) ? $validator->listErrors("password") : ''?>
                    </div>      
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">confirm the password</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                        <?= isset($validator) ? $validator->listErrors("password_confirm") : ''?>
                    </div>      
                    <button type="submit" class="btn btn-primary">registration</button>
                </form>
            </div>
        </div>
    </div>
</main>
<? require_once COMPONENTS . '/footer.php' ?>
