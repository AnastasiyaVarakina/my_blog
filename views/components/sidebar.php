<div class="col-2" style="background-color: gainsboro;">
    <!-- боковая панель -->
    <h3 class="p-4">HOT post</h3>
    <div class="list-group">
        <? foreach ($sidebar_posts as $post) : ?>
            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                <?= $post['title'] ?>
            </a>
        <? endforeach ?>
    </div>
</div>