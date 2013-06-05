<div class="page">
    <h2><?= $post->title ?></h2>
    <?= $post->edit_link('Edit Page') ?>

    <div class="content"><?= $post->content ?></div>
    <small>Last updated: <?= $post->modified('g.ia jS F, Y') ?></small>
</div>