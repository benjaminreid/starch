<div class="post">
    <h2><?= $post->title ?></h2>
    <h3><?= $post->date('jS F, Y') ?></h3>

    <?= $post->edit_link() ?>

    <div class="content"><?= $post->content ?></div>
</div>